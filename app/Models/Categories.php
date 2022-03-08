<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;


    protected $fillable = ['name','image'];


    const IMAGE_PATH='upload/backend/Categories/';

        public function courses()
    {
        return $this->hasMany(Courses::class);
    }



}




