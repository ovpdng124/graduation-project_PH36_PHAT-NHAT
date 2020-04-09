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

    public function getOrderLabel($userId)
    {
        $month = strtoupper(now()->monthName);
        $day   = now()->day;
        $time  = str_replace(':', '', now()->toTimeString());

        return 'BI' . $month . $day . $time . $userId;
    }

    public function createOrder($params)
    {
        $orderData = [
            'user_id'     => $params['user_id'],
            'order_label' => $this->getOrderLabel($params['user_id']),
            'quantity'    => $params['total_quantity'],
            'total_price' => $params['total_price'],
            'method_type' => $params['method_type'],
            'status'      => Order::$status['Pending'],
            'is_sale'     => $params['is_sale'],
            'sale_price'  => $params['sale_price'],
            'voucher_id'  => $params['voucher_id'],
        ];

        $order = Order::create($orderData);

        return $this->createOrderProduct($order, $params);
    }

    public function createOrderProduct($order, $params)
    {
        $productAttributes = ProductAttribute::all();

        foreach ($params['products'] as $value) {
            $productAttribute = $productAttributes->where('sub_name', $value['sub_name'])->first();

            $orderProductData = [
                'order_id'             => $order->id,
                'product_attribute_id' => $productAttribute->id,
                'quantity'             => $value['quantity'],
                'price'                => $value['sub_price'],
            ];

            OrderProduct::create($orderProductData);
        }

        return true;
    }

    public function checkVoucherExist($vouchers)
    {
        if (count($vouchers) != 0) {
            return $vouchers->first();
        }

        return null;
    }

    public function getVoucherInfo($voucher, $totalPrice)
    {
        $discountPrice = $this->checkDiscountUnit($voucher, $totalPrice);
        $totalPayment  = $this->getTotalPayment($totalPrice, $discountPrice);

        $voucherId = $voucher->id;

        return [
            'voucher_id'     => $voucherId,
            'discount_price' => $discountPrice,
            'total_payment'  => $totalPayment,
        ];
    }

    public function checkDiscountUnit($voucher, $totalPrice)
    {
        if ($voucher->unit === '-') {
            return $discountPrice = $voucher->value;
        }

        return $discountPrice = ($voucher->value * $totalPrice) / 100;
    }

    public function getTotalPayment($totalPrice, $discountPrice)
    {
        $totalPayment = $totalPrice - $discountPrice;

        return ($totalPayment < 0) ? $totalPayment = 0 : $totalPayment;
    }

    public function getProductAttributes($orderProducts)
    {
        $productAttributes = [];

        foreach ($orderProducts as $item) {
            $productAttribute = $item->product_attributes->first();

            $productAttribute->quantity = $item->quantity;
            $productAttribute->price    = $item->price;
            $productAttribute->total    = $item->quantity * $item->price;

            $productAttributes[] = $productAttribute;
        }

        return $productAttributes;
    }

    public function getOrderDetail($orderProducts)
    {
        $order             = $orderProducts->first()->order;
        $productAttributes = $this->getProductAttributes($orderProducts);

        return [
            'order'              => $order,
            'product_attributes' => $productAttributes,
        ];
    }
}
