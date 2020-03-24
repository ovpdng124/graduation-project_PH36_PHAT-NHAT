<?php

namespace App\Http\Controllers\User;

use App\Entities\Product;
use App\Entities\ProductAttributes;
use App\Http\Controllers\Controller;
use App\Services\ProductService;

class UserController extends Controller
{
    /**
     * @var ProductService
     */
    protected $productService;

    public function __construct()
    {
        $this->productService = app(ProductService::class);
    }

    public function index()
    {
        $products          = Product::with('product_images')->orderByDesc('updated_at')->get();
        $productAttributes = ProductAttributes::with('order_products', 'product_images')->withCount('order_products')->orderByDesc('updated_at')->get();

        $newArrivals     = $this->productService->getNewArrivals(clone($products));
        $popularProducts = $this->productService->getPopularProducts(clone($productAttributes));

        $productData = [
            'new_arrivals'     => $newArrivals,
            'popular_products' => $popularProducts,
        ];

        return view('user.index.index', $productData);
    }

    public function profile()
    {
        echo "Hello user";
    }

    public function showDetailProduct($id)
    {
        $products = Product::with('product_images')->get();

        $data = $this->productService->getDetailProduct($id, $products);

        return view('user.index.detail_product', $data);
    }
}
