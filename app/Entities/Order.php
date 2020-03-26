<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [];

    public static $status = [
        'Pending'  => 0,
        'Shipping' => 1,
        'Paid'     => 2,
        'Complete' => 3,
        'Cancel'   => 4,
    ];

    public static $statusColor = ['warning', 'secondary', 'success', 'primary', 'danger'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function order_products()
    {
        return $this->hasMany(OrderProduct::class);
    }

    public function voucher()
    {
        return $this->belongsTo(Voucher::class);
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
