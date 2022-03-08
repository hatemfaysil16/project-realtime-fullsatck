<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactwithCourse extends Model
{
    use HasFactory;
    protected $fillable = ['name','email','mobile','message','category_id','courses_id'];

    public function category()
    {
        return $this->belongsTo(Categories::class);
    }

    public function courses()
    {
        return $this->belongsTo(Courses::class);
    }
}
