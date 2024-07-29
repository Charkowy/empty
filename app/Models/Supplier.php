<?php

namespace App\Models;

use App\Builders\SupplierBuilder;
use Illuminate\Support\Facades\DB;

/**
 * Class Supplier
 *
 * @property SupplierDetail $supplier_detail
 *
 * @package App\Models
 */
class Supplier extends User
{
    protected $table = 'users';
    protected $guard_name = 'web';

    public function getMorphClass()
    {
        return 'App\Models\User';
    }

    public static function boot()
    {
        parent::boot();

        static::addGlobalScope(function ($query) {
            $query->whereIn('users.id', User::role('supplier')->select('users.id'));
        });
    }

    public function supplier_detail()
    {
        return $this->hasOne(SupplierDetail::class, 'user_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'supplier_id');
    }

    public static function createWithRelations(array $attributes = [])
    {
        DB::beginTransaction();
        try {
            $supplier = parent::createWithRelations($attributes);
            $supplier->supplier_detail()->create($attributes);
            $supplier->assignRole('customer');
            $supplier->assignRole('supplier');
            DB::commit();
            return $supplier;
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public static function updateWithRelations(array $attributes = [], User $user)
    {
        DB::beginTransaction();
        try {
            parent::updateWithRelations($attributes, $user);
            $supplier = Supplier::find($user->id);
            $supplier->supplier_detail->update($attributes);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function newEloquentBuilder($query): SupplierBuilder
    {
        return new SupplierBuilder($query);
    }
}
