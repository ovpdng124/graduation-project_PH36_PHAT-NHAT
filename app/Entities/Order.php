<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        "user_id",
        "voucher_id",
        "quantity",
        "total_price",
        "method_type",
        "status",
        "is_sale",
        "sale_price",
        "order_label",
    ];

    public static $status = [
        'Pending'  => 0,
        'Shipping' => 1,
        'Paid'     => 2,
        'Complete' => 3,
    ];

    public static $statusColor = ['warning', 'secondary', 'success', 'primary'];

    public function user()
    {
        return $this->belongsTo(User::class)->withTrashed();
    }

    public function order_products()
    {
        return $this->hasMany(OrderProduct::class);
    }

    public function voucher()
    {
        return $this->belongsTo(Voucher::class)->withTrashed();
    }

    public function getColorStatusAttribute()
    {
        return self::$statusColor[$this->status];
    }

    public function getNameStatusAttribute()
    {
        return implode('', array_keys(self::$status, $this->status));
    }
}
