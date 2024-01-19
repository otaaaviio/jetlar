<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * \App\Models\VeterinaryCare
 *
 * @property int $veterinary_care_id
 * @property string $veterinary_care
 * @property Carbon|null $deleted_at
 */
class VeterinaryCare extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'veterinary_care_id';
    protected $table = "veterinary_cares";
    public $timestamps = false;

    protected $fillable = ['veterinary_care'];

    public function pets()
    {
        return $this->belongsToMany(Pet::class, 'pet_vet_cares', 'veterinary_care_id', 'pet_id');
    }
}
