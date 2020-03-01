<?php

namespace App\Filters;

use App\Helpers\GlobalHelper;

class FilterBase
{
    public function search($query, $search, $searchKey)
    {
        $searchKey = GlobalHelper::snakeCaseToPascalCase($searchKey);
        $decorator = 'searchBy' . $searchKey;

        if (method_exists($this, $decorator)) {
            return $this->$decorator($query, $search);
        }

        return true;
    }
}
