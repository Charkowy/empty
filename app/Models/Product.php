<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Builders\ProductBuilder;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Observers\ProductObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Casts\Attribute;

/**
 * Class Product
 *
 * @property int $id
 * @property int $supplier_id
 * @property int $relative_code
 * @property string $sku
 * @property string $name
 * @property string $description
 * @property int $regular_price
 * @property Carbon $price_date
 * @property Carbon $entry_date
 * @property string $status
 * @property string|null $observations
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 *
 * @property User $user
 * @property Collection|Order[] $orders
 * @property Collection|Category[] $categories
 *
 * @package App\Models
 */

 //#[ObservedBy([ProductObserver::class])]

class Product extends Model
{
	use SoftDeletes;
	protected $table = 'products';

	protected $casts = [
        'id' => 'int',
		'supplier_id' => 'int',
		'relative_code' => 'int',
		'regular_price' => 'int',
		'price_date' => 'datetime',
		'entry_date' => 'datetime'
	];

	protected $fillable = [
        'id',
		'supplier_id',
		'relative_code',
		'sku',
		'name',
		'description',
		'regular_price',
		'price_date',
		'entry_date',
		'status',
		'observations'
	];

	public function supplier()
	{
		return $this->belongsTo(User::class, 'supplier_id');
	}

	public function orders()
	{
		return $this->belongsToMany(Order::class)
					->withPivot('id')
					->withTimestamps();
	}

	public function categories()
	{
		return $this->belongsToMany(Category::class, 'product_category')
					->withPivot('id')
					->withTimestamps();
	}

    protected function brand(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->categories()->where('parent', 46)->get()->first() ?? (new Category())
        );
    }

    public function newEloquentBuilder($query): ProductBuilder
    {
        return new ProductBuilder($query);
    }
}
