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

    public function __construct()
    {
        $this->productAttributeService = app(ProductAttributeService::class);
        $this->colorDefaults           = GlobalHelper::$colorDefaults;
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

        return view('admin.products.product_attributes.create', compact('colorDefault', 'products'));
    }

    public function store(CreateProductAttributeRequest $request)
    {
        $this->productAttributeService->store($request);

        return redirect(route('product-attribute.index'))->with('success', 'Create Successfully!');
    }

    public function edit($id)
    {
        $colorDefault     = $this->colorDefaults;
        $productAttribute = ProductAttributes::find($id);

        return view('admin.products.product_attributes.edit', compact('productAttribute', 'colorDefault'));
    }

    public function update(EditProductAttributeRequest $request, $id)
    {
        $this->productAttributeService->update($request, $id);

        return redirect(route('product-attribute.index'))->with('success', 'Updated Successfully!');
    }

    public function destroy($id)
    {
        ProductAttributes::find($id)->delete();

        return redirect(route('product-attribute.index'))->with('success', 'Deleted Successfully');
    }
}
