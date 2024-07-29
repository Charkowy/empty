<?php

namespace App\Models;

use App\Builders\CustomerBuilder;
use Illuminate\Support\Facades\DB;

/**
 * Class Customer
 *
 *
 * @package App\Models
 */
class Customer extends User
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
            $query->whereIn('users.id', User::role('customer')->select('users.id'));
        });
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'billing_email', 'email');
    }

    public static function createWithRelations(array $attributes = [])
    {
        DB::beginTransaction();
        try {
            $customer = parent::createWithRelations($attributes);
            $customer->assignRole('customer');
            DB::commit();
            return $customer;
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
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function newEloquentBuilder($query): CustomerBuilder
    {
        return new CustomerBuilder($query);
    }
}
