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
        $products          = Product::with(['product_attributes', 'product_images'])->find($id);
        $productAttributes = $products->product_attributes->sortByDesc('updated_at');
        $productData       = [
            'product'            => $products,
            'product_attributes' => $productAttributes,
        ];

        return view('admin.products.detail', $productData);
    }

    public function create()
    {
        $categories = Category::all();

        return view('admin.products.create', compact('categories'));
    }

    public function store(CreateProductRequest $request)
    {
        $params = $request->except('_token', 'url', 'avatar');
        $avatar = $request->file('avatar');

        $this->productService->store($params, $avatar);

        return redirect($request->get('url'))->with('success', 'Created successfully!');
    }

    public function edit($id)
    {
        $product    = Product::find($id);
        $categories = Category::all();
        $route      = route('product.update', $product->id);
        $data       = [
            'product'    => $product,
            'categories' => $categories,
            'route'      => $route,
        ];

        return view('admin.products.edit', $data);
    }

    public function update(EditProductRequest $request, $id)
    {
        $params      = $request->except('_token', 'url', 'avatar');
        $avatar      = $request->file('avatar');
        $category_id = $request->get('category_id');

        $this->productService->update($params, $id, $avatar);

        if (strpos($request->url(), 'category')) {
            return redirect(route('category.show', $category_id))->with('success', 'Updated Successfully!');
        }

        return redirect(route('product.index'))->with('success', 'Updated Successfully!');
    }

    public function destroy($id)
    {
        Product::find($id)->delete();

        return redirect()->back()->with('success', 'Deleted Successfully');
    }
}
