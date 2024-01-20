<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * \App\Models\Pet
 *
 * @property int $pet_id
 * @property string $name
 * @property int $specie_id
 * @property int $gender_id
 * @property int $size_id
 * @property int $life_stage_id
 * @property string $description
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @method static Builder|Pet newModelQuery()
 * @method static Builder|Pet newQuery()
 * @method static Builder|Pet query()
 * @method static Builder|Pet whereCreatedAt($value)
 * @method static Builder|Pet whereImageId($value)
 * @method static Builder|Pet whereId($value)
 * @method static Builder|Pet whereName($value)
 * @method static Builder|Pet whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Pet extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'pet_id';
    protected $table = 'pet';

    protected $fillable = [
        'name',
        'specie_id',
        'gender_id',
        'size_id',
        'life_stage_id',
        'description',
    ];

    public function veterinaryCares()
    {
        return $this->belongsToMany(VeterinaryCare::class, 'pet_vet_care', 'pet_id', 'veterinary_care_id');
    }

    public function suitableLivings()
    {
        return $this->belongsToMany(SuitableLiving::class, 'pet_suit_living', 'pet_id', 'suitable_living_id');
    }

    public function sociableWith()
    {
        return $this->belongsToMany(SociableWith::class, 'pet_soc_with', 'pet_id', 'sociable_with_id');
    }

    public function temperaments()
    {
        return $this->belongsToMany(Temperament::class, 'pet_temperament', 'pet_id', 'temperament_id');
    }

    public function images()
    {
        return $this->belongsToMany(Image::class, 'pet_image', 'pet_id', 'image_id');
    }

    public function specie()
    {
        return $this->belongsTo(Specie::class, 'specie_id');
    }

    public function gender()
    {
        return $this->belongsTo(Gender::class, 'gender_id');
    }

    public function size()
    {
        return $this->belongsTo(Size::class, 'size_id');
    }

    public function lifeStage()
    {
        return $this->belongsTo(LifeStage::class, 'life_stage_id');
    }

    public function scopeSearch(Builder $query, string $search): Builder
    {
        return $query->where('name', 'ilike', "%{$search}%");
    }
}