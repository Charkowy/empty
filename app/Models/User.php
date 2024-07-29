<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Class\Util;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

/**
 * Class User
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property int $doc_number
 * @property string $email
 * @property Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $two_factor_secret
 * @property string|null $two_factor_recovery_codes
 * @property string|null $remember_token
 * @property string|null $facebook_id
 * @property string|null $google_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property SupplierDetail $supplier_detail
 * @property UserDetail $user_detail
 *
 * @package App\Models
 */
class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles, SoftDeletes;

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'doc_number',
        'email',
        'email_verified_at',
        'password',
        'two_factor_secret',
        'two_factor_recovery_codes',
        'remember_token',
        'facebook_id',
        'google_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token'
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'doc_number' => 'int',
            'two_factor_confirmed_at' => 'datetime',
        ];
    }

    public function user_detail()
    {
        return $this->hasOne(UserDetail::class, 'user_id');
    }


    /**
     * Get the user's first and last name.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn ($value, $attributes) => (isset($attributes['last_name']) && isset($attributes['first_name'])) ? ($attributes['last_name'] . ', ' . $attributes['first_name']) : null
        );
    }

    protected function firstName(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Util::strFormaterUc($value),
            set: fn ($value) => Util::strFormaterUc($value),
        );
    }

    protected function lastName(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Util::strFormaterUc($value),
            set: fn ($value) => Util::strFormaterUc($value),
        );
    }

    protected function email(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Str::lower($value),
            set: fn ($value) => Str::lower($value),
        );
    }

    protected function rolesName(): Attribute
    {
        return Attribute::make(
            get: fn ($value, $attributes) => $this->roles()->pluck('name')->implode(' | ')
        );
    }

    /**
     * Route notifications for the mail channel.
     *
     * @return  array<string, string>|string
     */

    public function routeNotificationForMail(Notification $notification): array
    {
        // Return email address and name...
        return [$this->email => $this->full_name];
    }

    public static function createWithRelations(array $attributes = [])
    {
        DB::beginTransaction();
        try {
            $user = self::create($attributes);
            $user->user_detail()->create($attributes);
            //Siempre le pongo rol de comprador
            $attributes['roles'][4] = 4;
            //$user->assignRole('customer');

            //Paso a int los ids para que la libreria no los busque en los names
            $user->syncRoles(array_map('intval', $attributes['roles']));

            DB::commit();
            return $user;
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public static function updateWithRelations(array $attributes = [], User $user)
    {
        DB::beginTransaction();
        try {
            $user->update($attributes);
            $user->user_detail->update($attributes);

            if (isset($attributes['roles'])) {
                //Paso a int los ids para que la libreria no los busque en los names
                $user->syncRoles(array_map('intval', $attributes['roles']));
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }
}
