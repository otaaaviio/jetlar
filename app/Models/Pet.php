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
 * @property string $temperament
 * @property string $description
 * @property int|null $photo_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read File|null $photo
 * @method static Builder|Pet newModelQuery()
 * @method static Builder|Pet newQuery()
 * @method static Builder|Pet query()
 * @method static Builder|Pet whereCreatedAt($value)
 * @method static Builder|Pet wherePhotoId($value)
 * @method static Builder|Pet whereId($value)
 * @method static Builder|Pet whereName($value)
 * @method static Builder|Pet whereImage($value)
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
        'temperament',
        'description',
        'photo_id',
    ];

    public function veterinary_cares()
    {
        return $this->hasMany(VeterinaryCare::class);
    }

    public function suitable_livings()
    {
        return $this->hasMany(SuitableLiving::class);
    }

    public function sociable_with()
    {
        return $this->hasMany(SociableWith::class);
    }

    public function pet_photos()
    {
        return $this->hasMany(PetPhoto::class);
    }

    public function scopeSearch(Builder $query, string $search): Builder
    {
        return $query->where('name', 'like', "%{$search}%");
    }
}