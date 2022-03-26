<?php

namespace App\Http\Controllers\api\pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\ContactUsResources;
use App\Http\Controllers\api\apiResponseTrait;
use App\Models\Contact;
use Illuminate\Support\Facades\Validator;

class ContactUsController extends Controller
{
    use apiResponseTrait;

    public function store(Request $request){

        // start validation
            $validator = Validator::make($request->all(), [
                'name' =>'required|not_regex:<script>|max:50|min:3',
                'email' => 'required|not_regex:<script>',
                'mobile' => 'required|not_regex:<script>|max:50|min:3',
                'message' => 'required|not_regex:<script>',
                ], [
                'name.required' =>'برجاء ادخال الاسم  ',
                'email.required' => 'برجاء ادخال   البريد الالكتروني ',
                'mobile.required' => 'برجاء ادخالي  رقم التلفون',
                'message.required' => 'برجاء ادخالي  الرسالة',
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
        $Contact = Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'message' => $request->message,
        ]);
        // end create

        return $this->apiResponse(new ContactUsResources($Contact),'is success store date',true);

    }


}
