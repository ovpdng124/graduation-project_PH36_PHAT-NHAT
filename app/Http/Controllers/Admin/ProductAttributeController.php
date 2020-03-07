<?php

namespace App\Http\Controllers\Admin;

use App\Entities\ProductAttributes;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateProductAttributeRequest;
use App\Http\Requests\EditProductAttributeRequest;
use App\Services\ProductAttributeService;
use Illuminate\Http\Request;

class ProductAttributeController extends Controller
{
    protected $productAttributeService;

    public function __construct()
    {
        $this->productAttributeService = app(ProductAttributeService::class);
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
        return view('admin.products.product_attributes.create');
    }

    public function store(CreateProductAttributeRequest $request)
    {
        $params = $request->except('_token');

        ProductAttributes::create($params);

        return redirect(route('product-attribute.index'))->with('success','Create Successfully!');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $productAttribute = ProductAttributes::find($id);

        return view('admin.products.product_attributes.edit',compact('productAttribute'));
    }

    public function update(EditProductAttributeRequest $request, $id)
    {
        $params = $request->except('_token');

        ProductAttributes::find($id)->update($params);

        return redirect(route('product-attribute.index'))->with('success','Updated Successfully!');

    }

    public function destroy($id)
    {
        ProductAttributes::destroy($id);


        return redirect(route('product-attribute.index'))->with('success', 'Deleted Successfully');
    }
}
