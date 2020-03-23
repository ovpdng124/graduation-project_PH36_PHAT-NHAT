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
        $products        = Product::with(['product_images', 'order_products'])->withCount('order_products')->orderByDesc('updated_at')->get();
        $newArrivals     = $this->productService->getNewArrivals(clone($products));
        $popularProducts = $this->productService->getPopularProducts(clone($products));
        $productData     = [
            'new_arrivals'     => $newArrivals,
            'popular_products' => $popularProducts,
        ];

        return view('user.index.index', $productData);
    }

    public function profile()
    {
        echo "Hello user";
    }

    public function showDetailsProduct($id)
    {
        $products = Product::with( 'product_images')->get();

        $data = $this->productService->showDetailsProduct($id, $products);

        return view('user.index.detail_product', $data);
    }
}
