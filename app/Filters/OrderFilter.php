<?php

namespace App\Filters;

class OrderFilter extends FilterBase
{
    public function searchByOrderLabel($query, $search)
    {
        return $query->where('order_label', 'like', "%$search%");
    }
}
