<?php

namespace App\Http\Controllers\Admin;

use App\Entities\Category;
use App\Entities\Product;
use App\Helpers\GlobalHelper;
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
    protected $messages;

    public function __construct()
    {
        $this->productService = app(ProductService::class);
        $this->messages       = GlobalHelper::$messages;
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
        $params = $request->except('_token', 'avatar');
        $avatar = $request->file('avatar');

        $this->productService->store($params, $avatar);

        if (strpos($request->url(), 'category')) {
            return redirect(route('category.show', $params['category_id']))->with($this->messages['create_success']);
        }

        return redirect(route('product.index'))->with($this->messages['create_success']);
    }

    public function edit($id)
    {
        $product    = Product::find($id);
        $categories = Category::all();
        $data       = [
            'product'    => $product,
            'categories' => $categories,
        ];

        return view('admin.products.edit', $data);
    }

    public function update(EditProductRequest $request, $id)
    {
        $params = $request->except('_token', 'avatar');
        $avatar = $request->file('avatar');

        $this->productService->update($params, $id, $avatar);

        if (strpos($request->url(), 'detail')) {
            return redirect(route('product.show', $id))->with($this->messages['update_success']);
        }

        return redirect(route('product.index'))->with($this->messages['update_success']);
    }

    public function destroy($id)
    {
        $product = Product::with('product_attributes')->find($id);

        foreach ($product->product_attributes as $product_attribute) {
            $product_attribute->delete();
        }

        $product->delete();

        return redirect()->back()->with($this->messages['delete_success']);
    }
}
