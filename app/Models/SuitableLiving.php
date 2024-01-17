<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuitableLiving extends Model
{
    use HasFactory;
    protected $table = "pet_suitable_livings";
    public $timestamps = false;

    protected $fillable = [
        'pet_id',
        'suitable_living',
    ];
}
