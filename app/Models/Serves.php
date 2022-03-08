<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Serves extends Model
{
    use HasFactory;

    const IMAGE_PATH='upload/backend/Serves/';


    protected $fillable = [
        'name',
        'image',
        'active',
        'description',
        'fullDescription',
        'price',
    ];
}
