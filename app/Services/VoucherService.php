<?php

namespace App\Services;

use App\Entities\Voucher;
use App\Filters\VoucherFilter;

class VoucherService
{
    protected $voucherFilter;

    public function __construct()
    {
        $this->voucherFilter = app(VoucherFilter::class);
    }

    public function getVouchers($limits, $search, $searchKey)
    {
        $query = Voucher::query();

        if (!empty($search) && !empty($searchKey)) {
            $query = $this->voucherFilter->search($query, $search, $searchKey);
        }

        return $query->orderByDesc('updated_at')->paginate($limits);
    }
}
