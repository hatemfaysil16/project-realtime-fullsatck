<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MailCreates extends Model
{
    use HasFactory;

    protected $fillable = ['users','subject','body'];

    public function users()
    {
        return $this->belongsToMany(User::class,'users_courses');
    }

}


