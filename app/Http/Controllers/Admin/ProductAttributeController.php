<?php

namespace App\Http\Controllers\Admin;

use App\Entities\Product;
use App\Entities\ProductAttributes;
use App\Helpers\GlobalHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateProductAttributeRequest;
use App\Http\Requests\EditProductAttributeRequest;
use App\Services\ProductAttributeService;
use Illuminate\Http\Request;

class ProductAttributeController extends Controller
{
    /**
     * @var ProductAttributeService
     */
    protected $productAttributeService;
    protected $colorDefaults;
    protected $messages;

    public function __construct()
    {
        $this->productAttributeService = app(ProductAttributeService::class);
        $this->colorDefaults           = GlobalHelper::$colorDefaults;
        $this->messages                = GlobalHelper::$messages;
    }

    public function index(Request $request)
    {
        $limits    = $request->get('limits', 10);
        $search    = $request->get('search', '');
        $searchKey = $request->get('searchBy', '');

        $productAttributes = $this->productAttributeService->getProducts($limits, $search, $searchKey);

        return view('admin.products.product_attributes.list', compact('productAttributes'));
    }

    public function create()
    {
        $colorDefault = $this->colorDefaults;
        $products     = Product::all();
        $data         = [
            'colors'   => $colorDefault,
            'products' => $products,
        ];

        return view('admin.products.product_attributes.create', $data);
    }

    public function store(CreateProductAttributeRequest $request)
    {
        $params     = $request->except('_token', 'thumbnails');
        $thumbnails = $request->file('thumbnails');

        $this->productAttributeService->store($params, $thumbnails);

        if (strpos($request->url(), 'product/')) {
            return redirect(route('product.show', $params['product_id']))->with($this->messages['create_success']);
        }

        return redirect(route('product-attribute.index'))->with($this->messages['create_success']);
    }

    public function edit($id)
    {
        $colorDefault     = $this->colorDefaults;
        $productAttribute = ProductAttributes::find($id);
        $products         = Product::all();
        $data             = [
            'colors'            => $colorDefault,
            'product_attribute' => $productAttribute,
            'products'          => $products,
        ];

        return view('admin.products.product_attributes.edit', $data);
    }

    public function update(EditProductAttributeRequest $request, $id)
    {
        $params     = $request->except('_token', 'thumbnails');
        $thumbnails = $request->file('thumbnails');

        $this->productAttributeService->update($params, $id, $thumbnails);

        if (strpos($request->url(), 'product/')) {
            return redirect(route('product.show', $params['product_id']))->with($this->messages['update_success']);
        }

        return redirect(route('product-attribute.index'))->with($this->messages['update_success']);
    }

    public function destroy($id)
    {
        ProductAttributes::find($id)->delete();

        return redirect()->back()->with($this->messages['delete_success']);
    }
}
