<?php

namespace App\Admin\Controllers\Products;

use App\Models\Brand;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use Encore\Admin\Traits\ModelTree;

/**
 * 品牌
 *
 * Description of BrandController
 * @author Alex
 */
class BrandController extends Controller
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
            ->header('品牌管理')
            ->description('品牌列表')
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
            ->header('查看品牌')
            ->description("")
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
            ->header('修改')
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
            ->header('新建品牌')
            ->body($this->form());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Brand);
        $grid->column("id", "ID")->sortable();
        $grid->column("name", "品牌名称")->editable();
        $grid->column("description", "品牌描述")->editable();
        $grid->column("img_url", "品牌图片地址");
        $grid->column("priority", "优先级")->sortable()->editable();
        $grid->column("is_show", "是否展示")->display(function ($value) {
            switch ($value) {
                case 0:
                    return "否";
                case 1:
                    return "是";
            }
        });
        $grid->column("is_new", "是否新品牌")->display(function ($value) {
            switch ($value) {
                case 0:
                    return "否";
                case 1:
                    return "是";
            }
        });

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
        $show = new Show(Brand::findOrFail($id));

        $show->field('id', 'ID')->disabled();
        $show->field("name", "品牌名称");
        $show->field("description", "品牌描述");
        $show->field("img_url", "品牌图片地址");
        $show->field("priority", "优先级");
        $show->field("is_show", "是否展示")->using([0 => "否", 1 => "是"]);
        $show->field("is_new", "是否新品牌")->using([0 => "否", 1 => "是"]);

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Brand);

        $form->display('id', 'ID');
        $form->text("name", "品牌名称");
        $form->text("description", "品牌描述");
        $form->text("img_url", "品牌图片地址");
        $form->text("priority", "优先级")->default(10);
        $form->switch("is_show", "是否展示")->options([0 => "否", 1 => "是"])->default(1);
        // $form->text("floor_price", "品牌底价");
        $form->switch("is_new", "是否新品牌")->options([0 => "否", 1 => "是"])->default(0);

        return $form;
    }
}
