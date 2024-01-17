<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SociableWith extends Model
{
    use HasFactory;
    protected $table = "pet_sociable_with";
    public $timestamps = false;

    protected $fillable = [
        'pet_id',
        'sociable_with',
    ];
}
