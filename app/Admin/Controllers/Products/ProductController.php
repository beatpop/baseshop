<?php

namespace App\Admin\Controllers\Products;

use App\Models\Brand;
use App\Models\Product;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use Encore\Admin\Traits\ModelTree;

/**
 * 商品
 *
 * Description of ProductController
 * @author Alex
 */
class ProductController extends Controller
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
            ->header('商品管理')
            ->description('商品列表')
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
            ->header('商品详细')
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
            ->header('修改商品信息')
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
            ->header('新增商品')
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
        $grid = new Grid(new Product);

        $grid->column('id', 'ID');
        $grid->column('brand_id', '品牌');
        $grid->column('product_number', '商品编号');
        $grid->column('name', '商品名称');
        $grid->column('amount', '库存量');
        $grid->column('keywords', '关键字');
        /*$grid->column('brief', '简述');
        $grid->column('description', '描述');*/
        $grid->column('is_on_sale', '是否上架')->using([0 => '否', 1 => '是']);
        $grid->column('priority', '优先级');
        // $grid->column('is_delete', '是否已删除')->using([0 => '否', 1 => '是']);
        $grid->column('original_price', '原价');
        $grid->column('retail_price', '零售价');
        // $grid->column('extra_price', '额外价格');
        $grid->column('freight_price', '运费');
        $grid->column('is_new', '是否新品')->using([0 => '否', 1 => '是']);
        $grid->column('unit', '商品单位');
        $grid->column('primary_picture', '商品主图地址');
        $grid->column('picture_list', '商品详细图列表');
        $grid->column('sell_volume', '销售量');
        /*$grid->column('primary_product_id', '商品主SKU');
        $grid->column('unit_price', '单位价格');
        $grid->column('is_promotion', '是否促销')->using([0 => '否', 1 => '是']);
        $grid->column('promotion_price', '促销价格');
        $grid->column('promotion_description', '促销描述');
        $grid->column('is_limited', '是否限购')->using([0 => '否', 1 => '是']);
        $grid->column('limited_number', '限购数量');
        $grid->column('is_hot', '是否推荐')->using([0 => '否', 1 => '是']);
        $grid->column('created_at', '创建时间');
        $grid->column('updated_at', '更新时间');*/

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
        $show = new Show(Product::findOrFail($id));

        $show->field('id', 'ID');
        $show->field('brand_id', '品牌')->setValue(Brand::find($this->brand_id));
        $show->field('product_number', '商品编号');
        $show->field('name', '商品名称');
        $show->field('amount', '库存量');
        $show->field('keywords', '关键字');
        $show->field('brief', '简述');
        $show->field('description', '描述');
        $show->field('is_on_sale', '是否上架')->using([0 => '否', 1 => '是']);
        $show->field('priority', '优先级');
        // $show->field('is_delete', '是否已删除')->using([0 => '否', 1 => '是']);
        $show->field('original_price', '原价');
        $show->field('retail_price', '零售价');
        // $show->field('extra_price', '额外价格');
        $show->field('freight_price', '运费');
        $show->field('is_new', '是否新品')->using([0 => '否', 1 => '是']);
        $show->field('unit', '商品单位');
        $show->field('primary_picture', '商品主图地址');
        $show->field('picture_list', '商品详细图列表');
        $show->field('sell_volume', '销售量');
        /*$show->field('primary_product_id', '商品主SKU');
        $show->field('unit_price', '单位价格');
        $show->field('is_promotion', '是否促销')->using([0 => '否', 1 => '是']);
        $show->field('promotion_price', '促销价格');
        $show->field('promotion_description', '促销描述');
        $show->field('is_limited', '是否限购')->using([0 => '否', 1 => '是']);
        $show->field('limited_number', '限购数量');
        $show->field('is_hot', '是否推荐')->using([0 => '否', 1 => '是']);
        $show->field('created_at', '创建时间');
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
        $form = new Form(new Product);

        $brands = Brand::all()->pluck("name", "id")->toArray();

        $form->display('id', 'ID');
        $form->select('brand_id', '品牌')->options($brands);
        $form->text('product_number', '商品编号');
        $form->text('name', '商品名称');
        $form->number('amount', '商品库存');
        $form->text('keywords', '关键词');
        $form->text('brief', '简介');
        $form->textarea('description', '商品描述');
        $form->switch('is_on_sale', '是否上架')->default(1);
        $form->number('priority', '优先级')->default(100);
        // $form->switch('is_delete', '删除状态');
        $form->decimal('original_price', '原价')->default(0.00);
        $form->decimal('retail_price', '零售价')->default(0.00);
        // $form->decimal('extra_price', '额外价格')->default(0.00);
        $form->decimal('freight_price', '运费')->default(0.00);
        $form->switch('is_new', '是否新品')->default(0);
        $form->text('unit', '商品单位')->default('');
        $form->text('primary_picture', '商品主图URL')->default('');
        $form->textarea('picture_list', '详情图列表');
        $form->number('sell_volume', '销量')->default(0);
        // $form->text('primary_product_id', '主SKU ID')->default("000000001");
        $form->decimal('unit_price', '单位价格')->default(0.00);
        $form->switch('is_promotion', '是否促销')->default(0);
        $form->decimal('promotion_price', '促销价格')->default(0.00);
        $form->textarea('promotion_description', '促销描述');
        $form->switch('is_limited', '是否限购')->default(0);
        $form->number('limited_number', '限购数量')->default(0);
        $form->switch('is_hot', '是否推荐')->default(0);

        return $form;
    }
}
