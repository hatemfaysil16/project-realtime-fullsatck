<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialVideo extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'video',
        'youtube',
        'image',
        'description',
        'active'
    ];
}
