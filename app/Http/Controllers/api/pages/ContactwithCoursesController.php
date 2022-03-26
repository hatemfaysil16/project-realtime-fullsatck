<?php

namespace App\Http\Controllers\api\pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\ContactwithCoursesResources;
use App\Http\Controllers\api\apiResponseTrait;
use App\Models\ContactwithCourse;
use Illuminate\Support\Facades\Validator;

class ContactwithCoursesController extends Controller
{
    use apiResponseTrait;

    public function store(Request $request){

        // start validation
            $validator = Validator::make($request->all(), [
                'name' =>'required|not_regex:<script>|max:50|min:3',
                'email' => 'required|not_regex:<script>',
                'mobile' => 'required|not_regex:<script>|max:50|min:3',
                'message' => 'required|not_regex:<script>',
                'category_id' => 'not_regex:<script>',
                'courses_id' => 'not_regex:<script>',
                ], [
                'name.required' =>'برجاء ادخال الاسم  ',
                'email.required' => 'برجاء ادخال   البريد الالكتروني ',
                'mobile.required' => 'برجاء ادخالي  رقم التلفون',
                'message.required' => 'برجاء ادخالي  الرسالة',
                'message.category_id' => 'برجاء ادخالي  الفئة',
                'message.courses_id' => 'برجاء ادخالي  الكورس',
                ]);

            $errors = $validator->errors();
            if($errors->any())
            {
                foreach ($errors->all() as $error) {
                return  $this->apiResponse(null,$error,false);
            }
            }
        // end validation



        // start create
        $Contact = ContactwithCourse::create([
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'message' => $request->message,
            'category_id' => $request->category_id,
            'courses_id' => $request->courses_id,
        ]);
        // end create

        return $this->apiResponse(new ContactwithCoursesResources($Contact),'is success store date',true);

    }


}
