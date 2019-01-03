<?php

namespace App\Admin\Controllers\Products;

use App\Models\User;
use App\Models\UserAddress;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class UserAddressController extends Controller
{
    use HasResourceActions;

    /**
     * Index interface.
     *
     * @param Content $content
     * @return Content
     */
    public function index(Content $content)
    {
        return $content
            ->header('用户地址列表')
            ->description('')
            ->body($this->grid());
    }

    /**
     * Show interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function show($id, Content $content)
    {
        return $content
            ->header('查看用户地址')
            ->description('')
            ->body($this->detail($id));
    }

    /**
     * Edit interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function edit($id, Content $content)
    {
        return $content
            ->header('编辑用户地址')
            ->description('')
            ->body($this->form()->edit($id));
    }

    /**
     * Create interface.
     *
     * @param Content $content
     * @return Content
     */
    public function create(Content $content)
    {
        return $content
            ->header('Create')
            ->description('description')
            ->body($this->form());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new UserAddress);

        $grid->column('id', 'Id');
        $grid->column('user_name', '收件人');
        $grid->column('mobile', '电话');
        $grid->column('user_id', '用户');
        $grid->column('province_id', '省份ID');
        $grid->column('province', '省份');
        $grid->column('city_id', '城市ID');
        $grid->column('city', '城市');
        $grid->column('district_id', '县区ID');
        $grid->column('district', '县区');
        $grid->column('address', '详细地址');
        $grid->column('post_code', '邮政编码');
        $grid->column('is_default', '是否默认地址')->using([0 => '否', 1 => '是']);
        $grid->column('last_used_at', '最后使用时间');
        $grid->column('deleted_at', '删除时间');
        /*$grid->column('created_at', 'Created at');
        $grid->column('updated_at', 'Updated at');*/

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(UserAddress::findOrFail($id));

        $show->field('id', 'Id');
        $show->field('user_name', '收件人');
        $show->field('mobile', '电话');
        $show->field('user_id', '用户');
        $show->field('province_id', '省份ID');
        $show->field('province', '省份');
        $show->field('city_id', '城市ID');
        $show->field('city', '城市');
        $show->field('district_id', '县区ID');
        $show->field('district', '县区');
        $show->field('address', '详细地址');
        $show->field('post_code', '邮政编码');
        $show->field('is_default', '是否默认地址')->using([0 => '否', 1 => '是']);
        $show->field('last_used_at', '最后使用时间');
        $show->field('deleted_at', '删除时间');
        /*$show->field('created_at', 'Created at');
        $show->field('updated_at', 'Updated at');*/

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new UserAddress);

        $users = User::all()->pluck("name", "id")->toArray();

        $form->text('user_name', '收件人');
        $form->mobile('mobile', '电话');
        $form->select('user_id', '用户')->options($users);
        $form->distpicker([
            'province_id' => '省',
            'city_id'     => '市',
            'district_id' => '区'
        ])->attribute('data-value-type', 'code');
        $form->text('province', '省份');
        $form->text('city', '城市');
        $form->text('district', '县区');
        $form->text('address', '详细地址');
        $form->text('post_code', '邮政编码');
        $form->switch('is_default', '是否默认');
        $form->datetime('last_used_at', '最后一次使用时间')->default(date('Y-m-d H:i:s'));

        return $form;
    }
}
