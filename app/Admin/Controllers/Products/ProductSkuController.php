<?php

namespace App\Admin\Controllers\Products;

use App\Models\Product;
use App\Models\ProductSku;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class ProductSkuController extends Controller
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
            ->header('商品sku列表')
            ->description('商品sku')
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
            ->header('商品sku详细')
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
            ->header('商品sku编辑')
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
            ->header('创建商品sku')
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
        $grid = new Grid(new ProductSku);

        $grid->column('id', 'ID');
        $grid->column('name', 'sku名称')->editable();
        $grid->column('sku_number', 'sku编号')->editable();
        // $grid->column('description', 'sku描述');
        $grid->product("所属商品")->display(function ($product) {
            return $product['name'];
        });
        $grid->column('price', '原价')->editable();
        $grid->column('stock', '库存量')->editable();
        $grid->column('is_on_sale', '是否上架')->using([0 => '否', 1 => '是']);
        $grid->column('primary_picture', '商品主图');
        $grid->column('retail_price', '零售价格')->editable();
        $grid->column('is_promotion', '是否促销')->using([0 => '否', 1 => '是']);
        $grid->column('promotion_price', '促销价格')->editable();

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
        $productSku = ProductSku::findOrFail($id);
        $show = new Show($productSku);

        $show->field('id', 'ID');
        $show->field('name', 'sku名称');
        $show->field('sku_number', 'sku编号');
        $show->field('description', 'sku描述');
        $show->field('product', '所属商品')->as(function ($product) {
            return $product->name;
        });
        $show->field('price', '原价');
        $show->field('stock', '库存量');
        $show->field('is_on_sale', '是否上架')->using([0 => '否', 1 => '是']);
        $show->field('primary_picture', '商品主图');
        $show->field('retail_price', '零售价格');
        $show->field('is_promotion', '是否促销')->using([0 => '否', 1 => '是']);
        $show->field('promotion_price', '促销价格');

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new ProductSku);

        $products = Product::all()->pluck("name", "id")->toArray();

        $form->display('id', 'ID');
        $form->text('name', 'sku名称');
        $form->text('sku_number', 'sku编号');
        $form->textarea('description', 'sku描述');
        $form->select('product_id', '所属商品')->options($products);
        $form->decimal('price', '原价');
        $form->number('stock', '库存量')->default(0);
        $form->switch('is_on_sale', '是否上架')->default(1);
        $form->text('primary_picture', '商品主图')->default('');
        $form->decimal('retail_price', '零售价格');
        $form->switch('is_promotion', '是否促销')->default(0);
        $form->decimal('promotion_price', '促销价格')->default(0.00);

        return $form;
    }
}
