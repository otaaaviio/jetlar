<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * \App\Models\Specie
 *
 * @property int $specie_id
 * @property string $specie
 * @property Carbon|null $deleted_at
 */
class Specie extends Model
{
    use HasFactory, SoftDeletes;

    public $timestamps = false;
    protected $table = 'species';
    protected $primaryKey = 'specie_id';
    protected $fillable = ['specie'];
}
