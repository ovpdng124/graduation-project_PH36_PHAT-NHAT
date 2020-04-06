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
        $order_product      = OrderProduct::with('order', 'product_attributes')->get();
        $order              = $this->orderService->getOrderDetail($id, $order_product);
        $product_attributes = $this->orderService->getProductAttributes($id, $order_product);
        $orders_status      = $this->orderService->getOrderStatus();
        $data               = [
            'order'              => $order,
            'product_attributes' => $product_attributes,
            'orders_status'      => $orders_status,
        ];

        return view('admin.orders.detail', $data);
    }

    public function updateStatus(Request $request, $id)
    {
        $status = $request->statusOrder;
        Order::find($id)->update(['status' => $status]);

        return redirect()->route('order.detail', $id);
    }
}
