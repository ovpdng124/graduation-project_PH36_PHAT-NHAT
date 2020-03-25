<?php

namespace App\Http\Controllers\User;

use App\Entities\Product;
use App\Entities\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\EditUserRequest;
use App\Services\ProductService;
use App\Http\Requests\ChangePasswordProfileRequest;
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

        return view('user.profile.profile', compact('user'));
    }

    public function edit($id)
    {
        $user = User::find($id);

        return view('user.profile.edit', compact('user'));
    }

    public function update(EditUserRequest $request, $id)
    {
        $params = $request->except('_token');

        User::find($id)->update($params);

        return redirect(route('profile'))->with('success', 'Update Success');
    }

    public function showDetailProduct($id)
    {
        $products = Product::with('product_images')->get();

        $data = $this->productService->getDetailProduct($id, $products);

        return view('user.index.detail_product', $data);
    }

    public function changePasswordUser()
    {
        return view('user.profile.profile_edit_password');
    }

    public function updatePasswordUser(ChangePasswordProfileRequest $request)
    {
        $params = $request->except('_token', 'password_confirmation');

        $status = $this->userService->updatePasswordProfile($params);

        if (!$status) {
            return redirect()->back()->withErrors(['current_password' => 'Wrong password!']);
        }

        return redirect(route('profile'))->with('success', 'Change Password Success');
    }
}
