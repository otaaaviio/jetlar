<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * \App\Models\Temperament
 *
 * @property int $temperament_id
 * @property string $temperament
 * @property Carbon|null $deleted_at
 */
class Temperament extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'temperament_id';
    protected $table = "temperament";
    public $timestamps = false;

    protected $fillable = ['temperament'];

    public function pet()
    {
        return $this->belongsToMany(Pet::class, 'pet_temperament', 'temperament_id', 'pet_id');
    }
}
