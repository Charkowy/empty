<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Builders\OrderBuilder;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Order
 *
 * @property int $id
 * @property int $customer_id
 * @property string $billing_email
 * @property string $status
 * @property string $discount_total
 * @property string $shipping_total
 * @property string $total
 * @property Carbon $date_created
 * @property Carbon $date_modified
 * @property Carbon $date_completed
 * @property Carbon $date_paid
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 *
 * @property Collection|Product[] $products
 * @property Customer $customer
 *
 * @package App\Models
 */
class Order extends Model
{
    use SoftDeletes;
    protected $table = 'orders';

    protected $casts = [
        'customer_id' => 'int',
        'total' => 'int',
        'date_created' => 'datetime',
        'date_modified' => 'datetime',
        'date_completed' => 'datetime',
        'date_paid' => 'datetime'
    ];

    protected $fillable = [
        'id',
        'customer_id',
        'billing_email',
        'status',
        'discount_total',
        'shipping_total',
        'total',
        'date_created',
        'date_modified',
        'date_completed',
        'date_paid'
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class)
            ->withPivot('id')
            ->withTimestamps();
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'billing_email', 'email');
    }

    public function newEloquentBuilder($query): OrderBuilder
    {
        return new OrderBuilder($query);
    }
}
