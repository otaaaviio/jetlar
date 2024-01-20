<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * \App\Models\Gender
 *
 * @property int $gender_id
 * @property string $gender
 * @property Carbon|null $deleted_at
 */
class Gender extends Model
{
    use HasFactory, SoftDeletes;

    public $timestamps = false;
    protected $table = 'gender';
    protected $primaryKey = 'gender_id';
    protected $fillable = ['gender'];
}
