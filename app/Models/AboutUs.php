<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;


class AboutUs extends Model
{
    use HasFactory;
    use HasTranslations;


    public $translatable = ['name','description','fullDescription'];

    protected $fillable = [
        'name',
        'description',
        'fullDescription',
        'active'
    ];
}

