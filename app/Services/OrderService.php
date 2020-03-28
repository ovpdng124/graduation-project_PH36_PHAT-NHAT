<?php

namespace App\Services;

use App\Entities\Order;
use App\Entities\OrderProduct;
use App\Entities\ProductAttribute;
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

    public function createOrder($params)
    {
        $order = Order::query();

        $orderData = [
            'user_id'     => $params['user_id'],
            'order_label' => 'BI' . strtoupper(now()->monthName) . now()->day . now()->year . $params['user_id'],
            'quantity'    => $params['total_quantity'],
            'total_price' => $params['total_price'],
            'method_type' => $params['method_type'],
            'status'      => Order::$status['Pending'],
            'is_sale'     => $params['is_sale'],
            'sale_price'  => $params['sale_price'],
            'voucher_id'  => $params['voucher_id'],
        ];

        $order = $order->create($orderData);

        return $this->createOrderProduct($order, $params);
    }

    public function createOrderProduct($order, $params)
    {
        $orderProduct      = OrderProduct::query();
        $productAttributes = ProductAttribute::query();

        foreach ($params['products'] as $value) {

            $productAttribute = $productAttributes->where('sub_name', $value['sub_name'])->first();

            $orderProductData = [
                'order_id'             => $order->id,
                'product_attribute_id' => $productAttribute->id,
                'quantity'             => $value['quantity'],
                'price'                => $value['sub_price'],
            ];

            $orderProduct->create($orderProductData);
        }

        return true;
    }
}
