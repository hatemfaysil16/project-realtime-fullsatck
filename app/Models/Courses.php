<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Categories;
use App\Models\Instructors;


class Courses extends Model
{
    use HasFactory;
    protected $fillable = ['image','name','lectures','duration','level','language','assessments','description','certification','fullDescription','active','instructor_id','categories_id','price'];


    const IMAGE_PATH='upload/backend/Courses/';


    public function category()
    {
        return $this->belongsTo(Categories::class,'categories_id','id');
    }

    public function instructor()
    {
        return $this->belongsTo(Instructors::class,'instructor_id','id');
    }





    public function users()
    {
        return $this->belongsToMany(User::class,'users_courses','user_id','courses_id');
    }

}
