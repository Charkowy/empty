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
 * Class UserDetail
 *
 * @property int $id
 * @property int $user_id
 * @property Carbon|null $birthday
 * @property string|null $phone
 * @property string|null $state
 * @property string|null $city
 * @property string|null $street
 * @property string|null $zip
 * @property string|null $instagram
 * @property string|null $observations
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 *
 * @property User $user
 *
 * @package App\Models
 */
class UserDetail extends Model
{
	use SoftDeletes;
	protected $table = 'user_details';

	protected $casts = [
		'user_id' => 'int',
		'birthday' => 'datetime'
	];

	protected $fillable = [
		'user_id',
		'birthday',
		'phone',
		'state',
		'city',
		'street',
		'zip',
		'instagram',
		'observations'
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}

    public function age(): Attribute
    {
        return Attribute::make(
            get: fn ($value, $attributes) => $attributes['birthday'] ?? Carbon::parse($attributes['birthday'])->age
        );
    }

    protected function birthday(): Attribute
    {
        return Util::mutatorDateFormat();
    }
}
