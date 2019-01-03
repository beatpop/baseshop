<?php

namespace App\Admin\Controllers\Products;

use App\Models\User;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class UserController extends Controller
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
            ->header('微信用户列表')
            ->description('微信用户列表')
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
            ->header('微信用户详情')
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
            ->header('编辑微信用户')
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
            ->header('创建微信用户')
            ->description('')
            ->body($this->form());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new User);

        $grid->column('id', 'Id');
        $grid->column('name', '姓名');
        $grid->column('email', '邮件');
        /*$grid->column('password', '密码');
        $grid->column('remember_token', 'Remember token');
        $grid->column('created_at', 'Created at');
        $grid->column('updated_at', 'Updated at');*/
        $grid->column('phone', '手机');
        $grid->column('wx_openid', 'openid');
        $grid->column('wx_unionid', 'unionid');
        $grid->column('wx_nick_name', 'nickName');
        $grid->column('wx_avatar_url', 'avatarUrl');
        $grid->column('wx_gender', '性别');
        $grid->column('wx_city', '城市');
        $grid->column('wx_province', '省份');
        $grid->column('wx_country', '国家');
        $grid->column('wx_language', '语言');
        $grid->column('login_ip', '登录ip');
        /*$grid->column('wx_session_key', 'sessionKey');
        $grid->column('wx_expires_in', 'expiresIn');
        $grid->column('third_session', 'ThirdSession');*/

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
        $show = new Show(User::findOrFail($id));

        $show->field('id', 'Id');
        $show->field('name', '姓名');
        $show->field('email', '邮件');
        /*$show->field('password', '密码');
        $show->field('remember_token', 'Remember token');
        $show->field('created_at', 'Created at');
        $show->field('updated_at', 'Updated at');*/
        $show->field('phone', '手机');
        $show->field('wx_openid', 'openid');
        $show->field('wx_unionid', 'unionid');
        $show->field('wx_nick_name', 'nickName');
        $show->field('wx_avatar_url', 'avatarUrl');
        $show->field('wx_gender', '性别');
        $show->field('wx_city', '城市');
        $show->field('wx_province', '省份');
        $show->field('wx_country', '国家');
        $show->field('wx_language', '语言');
        $show->field('login_ip', '登录ip');
        /*$show->field('wx_session_key', 'sessionKey');
        $show->field('wx_expires_in', 'expiresIn');
        $show->field('third_session', 'ThirdSession');*/

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new User);

        $form->hidden('id', 'ID');
        $form->text('name', '姓名');
        $form->email('email', '邮件');
        $form->hidden('password', '密码')->default('SDFSDJKFJHSUIXCMXZKC');
        $form->hidden('remember_token', 'Remember token')->default('');
        $form->mobile('phone', '手机');
        $form->text('wx_openid', 'openid');
        $form->text('wx_unionid', 'unionid');
        $form->text('wx_nick_name', 'nickName');
        $form->text('wx_avatar_url', 'avatarUrl');
        $form->text('wx_gender', '性别');
        $form->text('wx_city', '城市');
        $form->text('wx_province', '省份');
        $form->text('wx_country', '国家');
        $form->text('wx_language', '语言');
        $form->text('login_ip', '登录ip');
        /*$form->text('wx_session_key', 'sessionKey');
        $form->text('wx_expires_in', 'expiresIn');
        $form->text('third_session', 'ThirdSession');*/

        return $form;
    }
}
