<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Instructors extends Model
{
    use HasFactory;

    protected $fillable = ['name','title','email','description','image','specialty','education','experience','cert_no','birthday','user_id'];

    const IMAGE_PATH='upload/backend/instructors/';


    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }

}



