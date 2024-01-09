<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;

/**
 * \App\Models\Pet
 *
 * @property int $id
 * @property string $name
 * @property string $normalized_name
 * @property string $specie
 * @property string $gender
 * @property string $size
 * @property string $age
 * @property string $veterinary_care
 * @property string $temperament
 * @property string $suitable_living
 * @property string $sociable_with
 * @property string $description
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Pet newModelQuery()
 * @method static Builder|Pet newQuery()
 * @method static Builder|Pet query()
 * @method static Builder|Pet whereCreatedAt($value)
 * @method static Builder|Pet whereId($value)
 * @method static Builder|Pet whereName($value)
 * @method static Builder|Pet whereNormalizedName($value)
 * @method static Builder|Pet whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Pet extends Model
{
    protected $fillable = [
        'name',
        'normalized_name',
        'specie',
        'gender',
        'size',
        'age',
        'veterinary_care',
        'temperament',
        'suitable_living',
        'sociable_with',
        'description',
    ];

    public function scopeSearch(Builder $query, string $search): Builder
    {
        return $query->where('name', 'like', "%{$search}%");
    }

    
}