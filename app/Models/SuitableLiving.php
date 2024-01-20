<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * \App\Models\SuitableLiving
 *
 * @property int $suitable_living_id
 * @property string $suitable_living
 * @property Carbon|null $deleted_at
 */
class SuitableLiving extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'suitable_living_id';
    protected $table = "suitable_living";
    public $timestamps = false;

    protected $fillable = ['suitable_living'];

    public function pet()
    {
        return $this->belongsToMany(Pet::class, 'pet_suit_living', 'suitable_living_id', 'pet_id');
    }
}
