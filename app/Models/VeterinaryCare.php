<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VeterinaryCare extends Model
{
    use HasFactory;
    protected $table = "pet_veterinary_cares";
    public $timestamps = false;

    protected $fillable = [
        'pet_id',
        'veterinary_care',
    ];
}
