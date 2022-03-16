<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
class OurTeam extends Model
{
    use HasFactory;
    use HasTranslations;


    public $translatable = ['name','description'];

    protected $fillable = [
        'name',
        'description',
        'image',
        'active'
    ];

    const IMAGE_PATH='upload/backend/OurTeam/';



}
