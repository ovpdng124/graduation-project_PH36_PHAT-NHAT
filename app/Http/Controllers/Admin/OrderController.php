<?php

namespace App\Http\Controllers\Admin;

use App\Entities\Order;
use App\Entities\ProductAttribute;
use App\Helpers\GlobalHelper;
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
        $productAttributes = ProductAttribute::withTrashed()->with('product_images', 'order_products')->whereHas('order_products', function ($query) use ($id) {
            $query->where('order_id', $id);
        })->get();

        $orderDetail = $this->orderService->getOrderDetail($productAttributes, $id);

        return view('admin.orders.detail', $orderDetail);
    }

    public function updateStatus(Request $request, $id)
    {
        $status = $request->except('_token');

        Order::find($id)->update($status);

        return redirect()->route('order.detail', $id);
    }

    public function edit($id)
    {
        $order = Order::find($id);

        return view('admin.orders.edit', compact('order'));
    }

    public function update(Request $request, $id)
    {
        $params = $request->except('_token', 'voucher');

        Order::find($id)->update($params);

        return redirect(route('order.list'))->with(GlobalHelper::$messages['update_success']);
    }

    public function delete($id)
    {
        Order::find($id)->delete();

        return redirect()->back()->with(GlobalHelper::$messages['delete_success']);
    }
}
