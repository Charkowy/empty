<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Observers\MenuItemObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Spatie\Permission\Models\Role;

/**
 * Class MenuItem
 *
 * @property int $id
 * @property int $parent_id
 * @property int|null $permission_id
 * @property int|null $role_id
 * @property int $position
 * @property string|null $text
 * @property string|null $icon
 * @property string|null $icon_color
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 *
 * @property MenuItem $menu_item
 * @property Permission|null $permission
 * @property Collection|MenuItem[] $menu_items
 *
 * @package App\Models
 */

 #[ObservedBy([MenuItemObserver::class])]

class MenuItem extends Model
{
	use SoftDeletes;
	protected $table = 'menu_items';

	protected $casts = [
		'parent_id' => 'int',
		'permission_id' => 'int',
        'role_id' => 'int',
		'position' => 'int'
	];

	protected $fillable = [
		'parent_id',
		'permission_id',
		'role_id',
		'position',
		'text',
		'icon',
		'icon_color'
	];

	public function parent()
	{
		return $this->belongsTo(MenuItem::class, 'parent_id');
	}

	public function permission()
	{
		return $this->belongsTo(Permission::class);
	}

    public function role()
	{
		return $this->belongsTo(Role::class);
	}

	public function childs()
	{
		return $this->hasMany(MenuItem::class, 'parent_id');
	}
}
