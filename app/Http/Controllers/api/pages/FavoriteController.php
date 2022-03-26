<?php

namespace App\Http\Controllers\api\pages;
use App\Http\Controllers\Controller;
use App\Http\Resources\FavoriteResources;
use App\Models\Courses;
use App\Http\Controllers\api\apiResponseTrait;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    use apiResponseTrait;


    public function addFavorite(Request $request)
    {

        $id = $request->course_id;
        $course = Courses::find($id);
        $user = $request->user();

        
        if($course)
        {
            if(is_array($user->favorites->modelKeys()) && ! in_array($id, $user->favorites->modelKeys())){
                $user->favorites()->attach($id);
                return $this->apiResponse( null,'is success insert favorite',true);
            }else{
                return $this->apiResponse( null,'is used id courses',false);
            }

        }else{
            return $this->apiResponse(null, 'is not found courses', false);
        }

    }

    public function removeFavorite(Request $request)
    {
        $id= $request->course_id;
        $course = Courses::find($id);
        $user = $request->user();

        if($course)
        {
            if(is_array($user->favorites->modelKeys()) && in_array($id, $user->favorites->modelKeys())){
                $user->favorites()->detach($id);
                return $this->apiResponse( null,'is success delete favorite',true);
            }else{
                return $this->apiResponse( null,'is used id courses',false);
            }

        }else{
            return $this->apiResponse( null,'is not found courses',false);
        }

    }

    public function AllFavorite()
    {

        

        $users =  Auth::user();

       $id =  $users->id;


        $course = User::find($id)->favorites;
        if(count($course)>0){
            return $this->apiResponse( FavoriteResources::collection($course),'is success All Data favorite',true);
        }else{
            return $this->apiResponse( $course,'is field  Data favorite',false);
        }


    }



}



