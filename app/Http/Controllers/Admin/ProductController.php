<?php

namespace App\Http\Controllers\Admin;

use App\Entities\Category;
use App\Entities\Product;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\EditProductRequest;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productService;

    public function __construct()
    {
        $this->productService = app(ProductService::class);
    }

    public function index(Request $request)
    {
        $limits    = $request->get('limits', 10);
        $search    = $request->get('search', '');
        $searchKey = $request->get('searchBy', '');

        $products = $this->productService->getProducts($limits, $search, $searchKey);

        return view('admin.products.list', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();

        return view('admin.products.create', compact('categories'));
    }

    public function store(CreateProductRequest $request)
    {
        $params = $request->except('_token');

        Product::create($params);

        return redirect(route('product.index'))->with('success', 'Created successfully!');
    }

    public function edit($id)
    {
        $product    = Product::find($id);
        $categories = Category::all();

        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(EditProductRequest $request, $id)
    {
        $params = $request->except('_token');

        Product::find($id)->update($params);

        return redirect(route('product.index'))->with('success', 'Updated Successfully!');
    }

    public function destroy($id)
    {
        Product::find($id)->delete();

        return redirect(route('product.index'))->with('success', 'Deleted Successfully');
    }
}
