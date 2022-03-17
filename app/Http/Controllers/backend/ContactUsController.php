<?php

namespace App\Http\Controllers\backend;
use App\Http\Controllers\Controller;
use App\Models\ContactUs;
use App\Repository\ContactUsRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


class ContactUsController extends Controller
{
    // ContactUsRepository
    protected $ContactUsRepository;
    public function __construct(ContactUsRepository $ContactUsRepository)
    {
        $this->ContactUsRepository = $ContactUsRepository;
    }

    public function index()
    {
        return view('backend.pages.ContactUs.index');
    }

    public function fetchData()
    {
        $AllData = $this->ContactUsRepository->all();

        $LocalizationCurrent = LaravelLocalization::getCurrentLocale();
        return response()->json([
            'AllData'=>$AllData,
            'LocalizationCurrent'=>$LocalizationCurrent
        ]);
    }



    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'=> 'required',
            'email'=> 'required',
            'phone'=> 'required',
            'message'=> 'required',
            'subject'=> 'required',
        ]);


        if($validator->fails())
        {
            return response()->json([
                'status'=>400,
                'errors'=>$validator->messages()
            ]);

        }else{

            $this->ContactUsRepository->store([
                'name'=>$request->name,
                'email'=>$request->email,
                'phone'=>$request->phone,
                'message'=>$request->message,
                'subject'=>$request->subject,
                'active'=>($request->active?1:0),
                'created_at'=>Carbon::now(),
            ]);


            return response()->json([
                'status'=>200,
                'message'=>__("backend/validation.store") ,
            ]);

        }

        // success add data Categories
    }

    public function edit($id)
    {
        $dataFind = $this->ContactUsRepository->get($id);

        if($dataFind)
        {
            $LocalizationCurrent = LaravelLocalization::getCurrentLocale();
            return response()->json([
                'status'=>200,
                'dataFind'=> $dataFind,
                'LocalizationCurrent'=>$LocalizationCurrent
            ]);
        }
        else
        {
            return response()->json([
                'status'=>404,
                'message'=>__("backend/validation.notFound") ,
            ]);
        }
    }

    public function update(Request $request,$id)
    {
        $validator = Validator::make($request->all(), [
            'name'=> 'required',
            'email'=> 'required',
            'phone'=> 'required',
            'message'=> 'required',
            'subject'=> 'required',
        ]);


        if($validator->fails())
        {
            return response()->json([
                'status'=>400,
                'errors'=>$validator->messages()
            ]);

        }else{


            $this->ContactUsRepository->update($id,[
                'name'=>$request->name,
                'email'=>$request->email,
                'phone'=>$request->phone,
                'message'=>$request->message,
                'subject'=>$request->subject,
                'active'=>($request->active?1:0),
                'created_at'=>Carbon::now(),
               ]);


               return response()->json([
                'status'=>200,
                'message'=>__("backend/validation.update"),
            ]);

        }

    }

    public function destroy($id)
    {
        ContactUs::find($id)->delete();
        return response()->json([
            'status'=>200,
            'message'=>__("backend/validation.delete"),
        ]);
    }

}
