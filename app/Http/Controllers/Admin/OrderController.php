<?php

namespace App\Http\Controllers\Admin;

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
        $order_product = OrderProduct::with('order', 'product_attributes')->get();

        $productAttributes = $this->orderService->getOrderDetail($id, $order_product);

        return view('admin.orders.detail', $productAttributes);
    }
}
