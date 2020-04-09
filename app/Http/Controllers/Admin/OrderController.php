<?php

namespace App\Http\Controllers\Admin;

use App\Entities\Order;
use App\Entities\OrderProduct;
use App\Http\Controllers\Controller;
use App\Services\OrderService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * @var OrderService
     */
    protected $orderService;

    public function __construct()
    {
        $this->orderService = app(OrderService::class);
    }

    public function showListOrder(Request $request)
    {
        $limits    = $request->get('limits', 10);
        $search    = $request->get('search', '');
        $searchKey = $request->get('searchBy', '');

        $orders = $this->orderService->getOrderList($limits, $search, $searchKey);

        return view('admin.orders.list', compact('orders'));
    }

    public function detail($id)
    {
        $orderProducts = OrderProduct::with('order', 'product_attributes')->where('order_id', $id)->get();

        $orderDetail = $this->orderService->getOrderDetail($orderProducts);

        return view('admin.orders.detail', $orderDetail);
    }

    public function updateStatus(Request $request, $id)
    {
        $status = $request->except('_token');

        Order::find($id)->update($status);

        return redirect()->route('order.detail', $id);
    }
}
