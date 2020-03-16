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
        $data         = [
            'colors'   => $colorDefault,
            'products' => $products,
        ];

        return view('admin.products.product_attributes.create', $data);
    }

    public function store(CreateProductAttributeRequest $request)
    {
        $params     = $request->except('_token', 'url', 'thumbnails');
        $thumbnails = $request->file('thumbnails');

        $this->productAttributeService->store($params, $thumbnails);

        return redirect($request->get('url'))->with('success', 'Create Successfully!');
    }

    public function edit($id)
    {
        $colorDefault     = $this->colorDefaults;
        $productAttribute = ProductAttributes::find($id);
        $data             = [
            'colors'            => $colorDefault,
            'product_attribute' => $productAttribute,
        ];

        return view('admin.products.product_attributes.edit', $data);
    }

    public function update(EditProductAttributeRequest $request, $id)
    {
        $params     = $request->except('_token', 'url', 'thumbnails');
        $thumbnails = $request->file('thumbnails');

        $this->productAttributeService->update($params, $id, $thumbnails);

        return redirect($request->get('url'))->with('success', 'Updated Successfully!');
    }

    public function destroy($id)
    {
        ProductAttributes::find($id)->delete();

        return redirect()->back()->with('success', 'Deleted Successfully');
    }
}
