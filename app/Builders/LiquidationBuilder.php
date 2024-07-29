<?php

namespace App\Builders;

use Illuminate\Database\Eloquent\Builder;

class LiquidationBuilder extends Builder
{
    public function byYearMonth($year, $month)
    {
        return $this->where('year', $year)
            ->where('month', $month);
    }

    /* public function partner()
    {
        return $this->where('role_id', config('constants.ADMINISTRATIVE_ID'));
    } */

    public function suppliers()
    {
        return $this->where('role_id', config('constants.SUPPLIER_ID'));
    }

    public function bySupplier($supplier_id)
    {
        return $this->suppliers()
            ->where('user_id', $supplier_id);
    }

    public function bySuppliers($supplier_ids)
    {
        return $this->suppliers()
            ->whereIn('user_id', $supplier_ids);
    }
}
