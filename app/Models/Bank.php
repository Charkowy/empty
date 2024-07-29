<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Bank
 *
 * @property int $id
 * @property string $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 *
 * @property Collection|SupplierDetail[] $supplier_details
 *
 * @package App\Models
 */
class Bank extends Model
{
	use SoftDeletes;
	protected $table = 'banks';

	protected $fillable = [
		'name'
	];

	public function supplier_details()
	{
		return $this->hasMany(SupplierDetail::class);
	}
}
