<?php

namespace App\Http\Controllers\User;

use App\Entities\Product;
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
        $newArrivals     = $this->showNewArrivals();
        $popularProducts = $this->showPopularProduct();
        $productData     = [
            'new_arrivals'     => $newArrivals,
            'popular_products' => $popularProducts,
        ];

        return view('user.index.index', compact('productData'));
    }

    public function showNewArrivals()
    {
        $products = Product::orderByDesc('created_at')->get();

        return $this->productService->getNewArrivals($products);
    }

    public function showPopularProduct()
    {
        $products = Product::withCount('order_products')
            ->orderByRaw("order_products_count DESC, updated_at DESC")
            ->with('product_images')
            ->take(3)
            ->get();

        return $this->productService->getPopularProducts($products);
    }

    public function profile()
    {
        echo "Hello user";
    }
}
