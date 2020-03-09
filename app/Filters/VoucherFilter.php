<?php

namespace App\Filters;

class VoucherFilter extends FilterBase
{
    public function searchByCode($query, $search)
    {
        return $query->where("code", "like", "%$search%");
    }

    public function searchByValue($query, $search)
    {
        return $query->where("value", "like", "%$search%");
    }

    public function searchByUnit($query, $search)
    {
        return $query->where("unit", "$search");
    }
}
