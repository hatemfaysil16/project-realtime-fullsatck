<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;


class Question extends Model
{
    use HasFactory;
    use HasTranslations;

    public $translatable = ['question','answer'];

    protected $fillable = [
        'question',
        'answer',
        'active'
    ];
}
