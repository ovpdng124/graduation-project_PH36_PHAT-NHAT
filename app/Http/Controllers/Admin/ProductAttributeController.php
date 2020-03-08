<?php

namespace App\Http\Controllers\Admin;

use App\Entities\ProductAttributes;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateColorRequest;
use App\Http\Requests\CreateProductAttributeRequest;
use App\Http\Requests\EditProductAttributeRequest;
use App\Services\ProductAttributeService;
use Illuminate\Http\Request;
use LVR\Colour\Hex;

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
        $productAttributes = ProductAttributes::all();

        return view('admin.products.product_attributes.create', compact('productAttributes'));
    }

    public function store(CreateProductAttributeRequest $request)
    {
        $params = $request->except('_token');

        ProductAttributes::create($params);

        return redirect(route('product-attribute.index'))->with('success', 'Create Successfully!');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $productAttribute = ProductAttributes::find($id);

        return view('admin.products.product_attributes.edit', compact('productAttribute'));
    }

    public function update(EditProductAttributeRequest $request, $id)
    {
        $params = $request->except('_token');

        ProductAttributes::find($id)->update($params);

        return redirect(route('product-attribute.index'))->with('success', 'Updated Successfully!');
    }

    public function destroy($id)
    {
        ProductAttributes::find($id)->delete($id);


        return redirect(route('product-attribute.index'))->with('success', 'Deleted Successfully');
    }

    public function createColorForm()
    {
        return view('admin.products.product_attributes.createColor');
    }

    public function createColor(CreateColorRequest $request)
    {
        $params = $request->except('_token');
        dd($params);
//        return redirect(route('product-attribute.create'));
    }
}
