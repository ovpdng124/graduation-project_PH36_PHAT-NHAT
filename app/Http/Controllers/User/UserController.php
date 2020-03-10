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
        $products = Product::orderByDesc('created_at')->get();

        $newArrivals = $this->productService->getNewArrivals($products);

        return view('user.index.index', compact('newArrivals'));
    }

    public function profile()
    {
        echo "Hello user";
    }
}
