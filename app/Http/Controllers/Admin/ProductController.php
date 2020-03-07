<?php

namespace App\Http\Controllers\Admin;

use App\Entities\Category;
use App\Entities\Product;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\EditProductRequest;
use App\Services\ProductService;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

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
        $params = $request->except('_token', 'avatar');

        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');

            $this->productService->updateAvatar($avatar, $id);
        }

        Product::find($id)->update($params);

        return redirect(route('product.index'))->with('success', 'Updated Successfully!');
    }

    /**
     * @param $id
     * @return RedirectResponse|Redirector
     * @throws Exception
     */
    public function destroy($id)
    {
        Product::find($id)->delete();

        return redirect(route('product.index'))->with('success', 'Deleted Successfully');
    }
}
