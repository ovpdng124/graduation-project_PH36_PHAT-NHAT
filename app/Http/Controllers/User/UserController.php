<?php

namespace App\Http\Controllers\User;

use App\Entities\Product;
use App\Entities\User;
use App\Http\Controllers\Controller;
use App\Services\ProductService;
use App\Services\UserService;
use Auth;


class UserController extends Controller
{
    /**
     * @var ProductService
     */
    protected $productService;
    protected $userService;

    public function __construct()
    {
        $this->productService = app(ProductService::class);
        $this->userService    = app(UserService::class);
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
        $user = Auth::user();

        return view('user.auth.profile', compact($user));
    }
}
