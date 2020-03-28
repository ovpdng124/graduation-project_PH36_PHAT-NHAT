<?php

namespace App\Http\Controllers\User;

use App\Entities\Product;
use App\Entities\ProductImage;
use App\Entities\User;
use App\Helpers\GlobalHelper;
use App\Entities\ProductAttribute;
use App\Http\Controllers\Controller;
use App\Http\Requests\EditUserRequest;
use App\Services\ProductService;
use App\Http\Requests\ChangePasswordProfileRequest;
use App\Services\UserService;
use Auth;
use Illuminate\Http\Request;

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
        $products          = Product::with('product_images')->orderByDesc('updated_at')->get();
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

        return redirect(route('profile'))->with($this->messages['change_password_success']);
    }

    public function showListCart()
    {
        return view('user.index.list_cart');
    }

    public function productCart(Request $request)
    {
        $params = $request->get('products');

        $productIDs = array_values(array_unique(array_column($params, 'product_id')));

        $productAttributes = ProductAttribute::whereIn('product_id', $productIDs)->get();
        $productImages     = ProductImage::whereIn('product_id', $productIDs)->where('image_type', ProductImage::$types['Thumbnail'])->get();

        $arr         = [];
        $total_price = [];

        foreach ($params as $product) {
            $productAttribute              = $productAttributes->where('product_id', $product['product_id'])->where('color', "#" . $product['color'])->first();
            $productImage                  = $productImages->where('product_id', $product['product_id'])->where('product_attribute_id', $productAttribute->id)->first();
            $productAttribute->image_path  = $productImage->image_path;
            $productAttribute->quantity    = $product['quantity'];
            $productAttribute->total_price = $productAttribute['sub_price'] * $product['quantity'];
            $arr[]                         = $productAttribute->toArray();
            $total_price[]                 = $productAttribute->total_price;
        }

        $data = [
            'products' => $arr,
            'total'    => array_sum($total_price),
        ];

        $html = view('user.index.product_cart', $data)->render();

        return response()->json($html);
    }
}
