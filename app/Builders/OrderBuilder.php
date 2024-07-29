<?php

namespace App\Builders;

use App\Class\Util;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class OrderBuilder extends Builder
{
    public function byYearMonth($year, $month)
    {
        return Util::byYearMonth($this, 'date_completed', $year, $month);
    }

    public function statusCompleted()
    {
        return $this->where('status', 'completed');
    }

    public function avalibleYears()
    {
        return $this->select(
            DB::raw("(DATE_FORMAT(date_completed, '%Y')) as year")
        )
            ->orderBy('date_completed')
            ->groupBy(DB::raw("DATE_FORMAT(date_completed, '%Y')"))
            ->whereNotNull('date_completed');
    }

    /* public function groupByYearMonth()
    {
        //Mejorar es del dashboard
        return $this->select(DB::raw('sum(products.price) as `total`'),  DB::raw('YEAR(sale_date) year, MONTH(sale_date) month'))
            ->join('sale_details', 'sales.id', '=', 'sale_details.sale_id')
            ->join('products', 'products.id', '=', 'sale_details.product_id')
            ->whereNotNull('sale_date')
            ->where('sale_date', '>=', '2020-06-01')
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month');
    } */

    /*  */

    /* public function getGroupByBuyer()
    {
        return $this->get()->groupBy('buyer_id');
    } */
}
