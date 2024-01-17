<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PetPhoto extends Model
{
    use HasFactory;
    protected $table = "pet_photos";
    public $timestamps = false;

    protected $fillable = [
        'pet_id',
        'file_id',
    ];
}
