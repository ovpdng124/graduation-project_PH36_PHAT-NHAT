<?php

namespace App\Http\Controllers\User;

use App\Entities\Order;
use App\Entities\ProductAttribute;
use App\Entities\Voucher;
use App\Http\Controllers\Controller;
use App\Services\OrderService;
use App\Services\ProductService;
use Auth;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * @var OrderService
     */
    protected $orderService;
    protected $productService;

    public function __construct()
    {
        $this->orderService   = app(OrderService::class);
        $this->productService = app(ProductService::class);
    }

    public function showOrderPage()
    {
        return view('user.orders.order');
    }

    public function showOrderForm(Request $request)
    {
        $params = $request->get('products');

        $data = $this->productService->getCartProducts($params);

        $data['user'] = Auth::user();

        return response()->json(view('user.orders.order_product_list', $data)->render());
    }

    public function checkVoucherCode(Request $request)
    {
        $voucherCode = $request->get('voucher_code');
        $totalPrice  = $request->get('total_price');

        $vouchers = Voucher::where('code', $voucherCode)->get();

        $voucher = $this->orderService->checkVoucherExist($vouchers);

        if (!empty($voucher)) {
            $data = $this->orderService->getVoucherInfo($voucher, $totalPrice);

            return response()->json($data);
        }

        return response()->json([
            'discount_price' => 'No discount',
        ]);
    }

    public function createOrder(Request $request)
    {
        $params = $request->except('_token', 'voucher');

        $this->orderService->createOrder($params);

        return redirect(route('order.info'))->with('success', 'Created order successfully!');
    }

    public function showOrderInformation()
    {
        $orders = Order::where('user_id', Auth::id())->orderByDesc('updated_at')->paginate(7);

        return view('user.orders.order_information', compact('orders'));
    }

    public function showOrderDetail($id)
    {
        $productAttributes = ProductAttribute::withTrashed()->with('product_images', 'order_products')->whereHas('order_products', function ($query) use ($id){
            $query->where('order_id', $id);
        })->get();

        $orderDetail = $this->orderService->getOrderDetail($productAttributes, $id);

        return view('user.orders.detail', $orderDetail);
    }
}
