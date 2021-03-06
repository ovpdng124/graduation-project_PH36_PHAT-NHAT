<?php

namespace App\Http\Controllers\User;

use App\Entities\Product;
use App\Entities\User;
use App\Helpers\GlobalHelper;
use App\Entities\ProductAttribute;
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
    protected $messages;

    public function __construct()
    {
        $this->productService = app(ProductService::class);
        $this->userService    = app(UserService::class);
        $this->messages       = GlobalHelper::$messages;
    }

    public function index()
    {
        $products          = Product::with('product_images')->orderByDesc('updated_at')->paginate(9);
        $productAttributes = ProductAttribute::with('order_products', 'product_images')->withCount('order_products')->orderByDesc('updated_at')->get();

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

        return redirect(route('profile'))->with($this->messages['update_success']);
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

        return redirect(route('profile'))->with($this->messages['change_password_success']);
    }
}
