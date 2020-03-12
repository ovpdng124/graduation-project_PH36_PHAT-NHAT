<?php

namespace App\Http\Controllers\Admin;

use App\Entities\Category;
use App\Entities\Product;
use App\Entities\ProductAttributes;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\EditProductRequest;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * @var ProductService
     *
     */
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

    public function show($id)
    {
        $productAttributes = ProductAttributes::where('product_id', $id)->orderByDesc('updated_at')->paginate(10);

        return view('admin.products.product_attributes.list', compact('productAttributes'));
    }

    public function create()
    {
        $categories = Category::all();

        return view('admin.products.create', compact('categories'));
    }

    public function store(CreateProductRequest $request)
    {
        if (!$this->productService->store($request)) {
            return redirect(route('product.index'))->with('failed', 'Create failed!');
        }

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
        $this->productService->update($request, $id);

        return redirect(route('product.index'))->with('success', 'Updated Successfully!');
    }

    public function destroy($id)
    {
        Product::find($id)->delete();

        return redirect(route('product.index'))->with('success', 'Deleted Successfully');
    }
}
