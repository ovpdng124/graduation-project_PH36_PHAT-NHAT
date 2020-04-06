<?php

namespace App\Services;

use App\Entities\Order;
use App\Filters\OrderFilter;

class OrderService
{
    /**
     * @var OrderFilter
     */
    protected $orderFilter;

    public function __construct()
    {
        $this->orderFilter = app(OrderFilter::class);
    }

    public function getOrderList($limits, $search, $searchKey)
    {
        $query = Order::query();

        if (!empty($search) && !empty($searchKey)) {
            $query = $this->orderFilter->search($query, $search, $searchKey);
        }

        return $query->orderByDesc('updated_at')->paginate($limits);
    }

    public function getProductAttributes($id, $order_products)
    {
        $order_product     = $order_products->where('order_id', $id);
        $productAttributes = [];

        foreach ($order_product as $item) {
            $productAttribute = $item->product_attributes->first();

            $productAttribute->quantity = $item->quantity;
            $productAttribute->price    = $item->price;
            $productAttribute->total    = $item->quantity * $item->price;

            $productAttributes[] = $item->product_attributes->first();
        }

        return $productAttributes;
    }

    public function getOrderDetail($id, $order_products)
    {
        $order_product = $order_products->where('order_id', $id);
        $order         = $order_product->first()->order;

        return $order;
    }

    public function getOrderStatus()
    {
        $orders_status = Order::$status;

        return $orders_status;
    }
}
