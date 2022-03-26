<?php

namespace App\Http\Controllers\api\pages;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use Illuminate\Http\Request;
use App\Http\Resources\category;
use App\Libs\Upload;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Image;
use App\Http\Controllers\api\apiResponseTrait;



//start test
class test extends Controller
{

    use apiResponseTrait;


    public function index(){
        $category =  Categories::all();
        if($category)
        {
         return $this->apiResponse( category::collection($category),'is success',true);
        }
    }

    public function store(Request $request){


        // start validation
            $validator = Validator::make($request->all(), [
                'name' => 'required|max:255',
                'image'=>'required|mimes:jpeg,png,jpg',
            ],[
                'name.required'=>'برجاء ادخال الاسم ',
                'image.required'=>'برجاء ادخال الصورة',
            ]);

            $errors = $validator->errors();
            if($errors->any())
            {
                foreach ($errors->all() as $error) {
                return  $this->apiResponse(null,$error,false);
            }
            }
        // end validation

        // start image
        $image =Upload::UploadImage('image','upload/backend/Categories',null,time(),300,300);
        // end image

        // start create
        $category = Categories::create([
            'name' => $request->name,
            'image'=>config('app.url').'upload/backend/Categories/'.$image,
        ]);
        // end create

        return $this->apiResponse(new category($category),'is success store date',true);

    }


    public function update(Request $request ,$id){



        // start validation
            $validator = Validator::make($request->all(), [
                'name' => 'required|max:255',
                'image'=>'required|mimes:jpeg,png,jpg',
            ],[
                'name.required'=>'برجاء ادخال الاسم ',
                'image.required'=>'برجاء ادخال الصورة',
            ]);

            $errors = $validator->errors();
            if($errors->any())
            {
                foreach ($errors->all() as $error) {
                return  $this->apiResponse(null,$error,false);
            }
            }
        // end validation




        $Categories=Categories::find($id);
        if(!$Categories){
            return $this->apiResponse(null,'The category Not Found',false);
        }

        // start image
        $image =Upload::UploadImage('image','upload/backend/Categories',$Categories,time(),300,300);
        // end image


        // start remove image
        $a = ($Categories->image);
        $b =  str_replace(config('app.url'),"",$a,$i);
        unlink($b);
        // end remove image


        // start update
        $category = Categories::find($id)->update([
            'name' => $request->name,
            'image'=>config('app.url').'upload/backend/Categories/'.$image,
        ]);
        // end update


        if($Categories){
            return $this->apiResponse(new category($Categories),'The category update',true);
        }

    }


    public function show($id){
        $category =  Categories::find($id);
        if($category)
        {
         return $this->apiResponse(new category($category),'is success show date',true);
        }else{
         return $this->apiResponse(null,'is failed show date',false);

        }
    }


    public function destroy($id)
    {

        $category = Categories::find($id);

        if(!$category){
        return $this->apiResponse(null,'the Categories is not found',false);
        }



        $a = ($category->image);

        $b =  str_replace(config('app.url'),"",$a,$i);
        unlink($b);

        $category->delete($id);


        if($category){
        return $this->apiResponse(null,'is success delete date',true);
        }

    }

    public function showdateStatic()
    {

      $date=json_decode(file_get_contents('../app/Http/Controllers/api/date.json'));
        foreach ($date as $key => $value) {
            foreach ($value as $key => $a) {
            $b=($a);
            }

     return $this->apiResponse($b,'is success de dsa sa salete date',true);

    }


}
//end test
