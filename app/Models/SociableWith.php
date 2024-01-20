<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * \App\Models\SociableWith
 *
 * @property int $sociable_with_id
 * @property string $sociable_with
 * @property Carbon|null $deleted_at
 */
class SociableWith extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'sociable_with_id';
    protected $table = "sociable_with";
    public $timestamps = false;

    protected $fillable = ['sociable_with'];

    public function pet()
    {
        return $this->belongsToMany(Pet::class, 'pet_soc_with', 'sociable_with_id', 'pet_id');
    }
}
