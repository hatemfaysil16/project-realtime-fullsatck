<?php

namespace App\Models;
use App\Models\Courses;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificates extends Model
{
    use HasFactory;

    protected $fillable = ['serial','from_date','to_date','grade','image','courses_id'];


    const IMAGE_PATH='upload/backend/Certificates/';


    public function course(){
        return $this->belongsTo(Courses::class,'courses_id','id');
    }


}
