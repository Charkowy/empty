<?php

namespace App\Builders;

use App\Models\Order;

class SupplierBuilder extends UserBuilder
{
    public function withProductsSoldByYearMonth($year, $month)
    {
        return $this->withProductsSold(Order::byYearMonth($year, $month));
    }

    public function withProductsSold($queryBuilder = null)
    {
        $queryBuilder = $queryBuilder ?? Order::query();
        $queryBuilder->statusCompleted();

        return $this->whereHas('products.orders', function ($query) use ($queryBuilder) {
            $query->mergeConstraintsFrom($queryBuilder);
        })->with(['products' => function ($query) use ($queryBuilder) {
            $query->whereHas('orders', function ($query) use ($queryBuilder) {
                $query->mergeConstraintsFrom($queryBuilder);
            });
        }])->orderBy('last_name');
    }
}
