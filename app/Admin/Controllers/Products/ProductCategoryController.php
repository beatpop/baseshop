<?php

namespace App\Admin\Controllers\Products;

use App\Models\ProductCategory;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use Encore\Admin\Traits\ModelTree;

/**
 * 商品分类
 *
 * Description of ProductCategoryController
 *
 * @author Alex
 */
class ProductCategoryController extends Controller
{
    use HasResourceActions;
    use ModelTree;

    /**
     * Index interface.
     *
     * @param Content $content
     * @return Content
     */
    public function index(Content $content)
    {
        return $content
            ->header('商品分类')
            ->description('商品分类列表')
            ->body($this->grid()->render());
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
            ->header('分类详情')
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
            ->header('修改商品分类')
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
            ->header('新增商品分类')
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
        $grid = new Grid(new ProductCategory);

        $grid->column('id', 'ID')->sortable();
        $grid->column('name', '分类名称')->editable();
        $grid->column('keywords', '关键词')->editable();
        // $grid->column('description', '描述');
        $grid->column('parent_id', '父级')->display(function ($value) {
            return ProductCategory::getParentName($value);
        });
        $grid->column('priority', '优先级')->sortable();
        $grid->column('is_show', '是否显示')->display(function ($value) {
            switch ($value) {
                case 0:
                    return "否";
                case 1:
                    return "是";
            }
        });
        /*$grid->column('banner_url', 'Banner图片地址');
        $grid->column('icon_url', 'icon图标地址');
        $grid->column('img_list', '图片列表');
        $grid->column('level', '级别');
        $grid->column('type', '类型');*/
        $grid->column('alias', '简写')->editable();
        /*$grid->column('created_at', '创建时间');
        $grid->column('updated_at', '修改时间');*/

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
        $show = new Show(ProductCategory::findOrFail($id));

        $show->field('id', 'ID');
        $show->field('name', '分类名称');
        $show->field('keywords', '关键词');
        $show->field('description', '描述');
        $show->field('parent_id', '父级ID');
        $show->field('priority', '优先级');
        $show->field('is_show', '是否显示')->using([0 => '否', 1 => '是']);
        /*$show->field('banner_url', 'Banner图片地址');
        $show->field('icon_url', 'icon图标地址');
        $show->field('img_list', '详情图列表');
        $show->field('level', '等级');
        $show->field('type', '类型');*/
        $show->field('alias', '简写');
        /*$show->field('created_at', '创建时间');
        $show->field('updated_at', '更新时间');*/

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new ProductCategory);

        $categoryModel = ProductCategory::all()->pluck('name', 'id')->toArray();

        $form->text('name', '分类名称')->rules("名称不可为空");
        $form->text('keywords', '关键词');
        $form->textarea('description', '描述');
        $form->select('parent_id', '父级')->options($categoryModel);
        $form->text('priority', '优先级')->default(50);
        $form->switch('is_show', '是否显示')->default(1);
        /*$form->text('banner_url', 'Banner图片地址');
        $form->text('icon_url', 'icon图片地址');
        $form->text('img_list', '详情图列表');
        $form->switch('level', '级别');
        $form->number('type', '类型');*/
        $form->text('alias', '简写');

        return $form;
    }
}
