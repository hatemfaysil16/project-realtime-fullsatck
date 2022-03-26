<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialVideo extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'body',
        'image',
        'youtube',
        'video',
        'in_home',
        'active'
    ];


    const IMAGE_PATH='upload/backend/Media_center/';
    const IMAGE_PATH_VIDEO='upload/backend/video/';

}