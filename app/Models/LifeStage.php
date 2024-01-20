<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * \App\Models\LifeStage
 *
 * @property int $life_stage_id
 * @property string $life_stage
 * @property Carbon|null $deleted_at
 */
class LifeStage extends Model
{
    use HasFactory, SoftDeletes;

    public $timestamps = false;
    protected $table = 'life_stage';
    protected $primaryKey = 'life_stage_id';
    protected $fillable = ['life_stage'];
}
