<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Builders\CategoryBuilder;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Category
 *
 * @property int $id
 * @property string $name
 * @property int|null $parent
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Category extends Model
{
    protected $table = 'categories';

    protected $casts = [
        'id' => 'int',
        'parent' => 'int'
    ];

    protected $fillable = [
        'id',
        'name',
        'parent'
    ];

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent')->with('children');
    }

    public function newEloquentBuilder($query): CategoryBuilder
    {
        return new CategoryBuilder($query);
    }
}
