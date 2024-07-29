<?php

namespace App\Builders;

class CustomerBuilder extends UserBuilder
{
    /* public function withProductsBuyByYearMonth($year, $month)
    {
        return $this->withProductsBuy(Sale::byYearMonth($year, $month));
    }

    public function withProductsBuy($queryBuilder = null)
    {
        $queryBuilder = $queryBuilder ?? Sale::query();

        return $this->whereHas('sales', function ($query) use ($queryBuilder) {
            $query->mergeConstraintsFrom($queryBuilder);
        })->with(['sales' => function ($query)  use ($queryBuilder) {
            $query->mergeConstraintsFrom($queryBuilder)->with('sale_details.product')
                ->withSum('sale_details', 'price_discount')
                ->withSum('products', 'price')
                ->orderBy('sale_date');
        }])->orderBy('last_name');
    } */
}
