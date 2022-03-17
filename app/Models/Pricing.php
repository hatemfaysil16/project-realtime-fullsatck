<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;


class Pricing extends Model
{
    use HasFactory;
    use HasTranslations;

    public $translatable = ['name','data','currency','type','description'];

    protected $fillable = ['name','price','data','currency','type','description','active'];

}
