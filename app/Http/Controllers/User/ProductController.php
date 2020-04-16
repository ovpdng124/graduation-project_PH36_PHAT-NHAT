<?php

namespace App\Http\Controllers\User;

use App\Entities\Product;
use App\Http\Controllers\Controller;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * @var ProductService
     */
    protected $productService;

    public function __construct()
    {
        $this->productService = app(ProductService::class);
    }

    public function showDetailProduct($id)
    {
        $products = Product::with('product_images')->get();

        $data = $this->productService->getDetailProduct($id, $products);

        return view('user.products.detail_product', $data);
    }

    public function showListCart()
    {
        return view('user.carts.list_cart');
    }

    public function showProductCart(Request $request)
    {
        $params = $request->get('products');

        if (empty($params)) {
            return response()->json("<td colspan='9' class='text-center'><i>There are no products to list</i></td>");
        }

        $data = $this->productService->getCartProducts($params);

        if (count($data['products']) == 0) {
            return response()->json(null);
        }

        return response()->json(view('user.carts.product_cart', $data)->render());
    }

    public function getShoppingProducts(Request $request)
    {
        $category = $request->get('category');

        $data = $this->productService->getShoppingProducts($category);

        return view('user.products.shop', $data);
    }
}
