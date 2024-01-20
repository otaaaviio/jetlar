<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * \App\Models\Size
 *
 * @property int $size_id
 * @property string $size
 * @property Carbon|null $deleted_at
 */
class Size extends Model
{
    use HasFactory, SoftDeletes;

    public $timestamps = false;
    protected $table = 'size';
    protected $primaryKey = 'size_id';
    protected $fillable = ['size'];
}
