<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Class\Util;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class SupplierDetail
 *
 * @property int $id
 * @property int $user_id
 * @property int $bank_id
 * @property string|null $cbu
 * @property string|null $alias
 * @property string|null $account_owner
 * @property string|null $account_number
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 *
 * @property Bank $bank
 * @property User $user
 *
 * @package App\Models
 */
class SupplierDetail extends Model
{
	use SoftDeletes;
	protected $table = 'supplier_details';

	protected $casts = [
		'user_id' => 'int',
		'bank_id' => 'int'
	];

	protected $fillable = [
		'user_id',
		'bank_id',
		'cbu',
		'alias',
		'account_owner',
		'account_number'
	];

	public function bank()
	{
		return $this->belongsTo(Bank::class);
	}

	public function supplier()
	{
		return $this->belongsTo(Supplier::class);
	}

    protected function alias(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => strtoupper($value),
            set: fn ($value) => strtoupper($value),
        );
    }

    protected function accountOwner(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Util::strFormaterUc($value),
            set: fn ($value) => Util::strFormaterUc($value),
        );
    }
}
