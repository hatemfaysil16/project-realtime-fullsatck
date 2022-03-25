<?php

namespace App\Http\Controllers\backend;
use App\Http\Controllers\Controller;
use App\Models\Pricing;
use App\Repository\PricingRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


class PricingController extends Controller
{
    // PricingRepository
    protected $PricingRepository;
    public function __construct(PricingRepository $PricingRepository)
    {
        $this->PricingRepository = $PricingRepository;
    }

    public function index()
    {
        return view('backend.pages.pricing.index');
    }

    public function fetchData()
    {
        $AllData = $this->PricingRepository->all();

        $LocalizationCurrent = LaravelLocalization::getCurrentLocale();
        return response()->json([
            'AllData'=>$AllData,
            'LocalizationCurrent'=>$LocalizationCurrent
        ]);
    }



    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name_ar'=> 'required',
            'name_en'=> 'required',
            'price'=> 'required',
            'data_ar'=> 'required',
            'data_en'=> 'required',
            'currency_ar'=> 'required',
            'currency_en'=> 'required',
            'type_ar'=> 'required',
            'type_en'=> 'required',
            'description_en'=> 'required',
            'description_en'=> 'required',
        ]);



        if($validator->fails())
        {
            return response()->json([
                'status'=>400,
                'errors'=>$validator->messages()
            ]);

        }else{

            $this->PricingRepository->store([
                'name'=>['ar'=>$request->name_ar,'en'=>$request->name_en],
                'price'=>$request->price,
                'data'=>['ar'=>$request->data_ar,'en'=>$request->data_en],
                'currency'=>['ar'=>$request->currency_ar,'en'=>$request->currency_en],
                'type'=>['ar'=>$request->type_ar,'en'=>$request->type_en],
                'description'=>['ar'=>$request->description_ar,'en'=>$request->description_en],
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
        $dataFind = $this->PricingRepository->get($id);

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
            'price'=> 'required',
            'data'=> 'required',
            'currency'=> 'required',
            'type'=> 'required',
            'description'=> 'required',
        ]);


        if($validator->fails())
        {
            return response()->json([
                'status'=>400,
                'errors'=>$validator->messages()
            ]);

        }else{


            $this->PricingRepository->update($id,[
                'name'=>$request->name,
                'price'=>$request->price,
                'data'=>$request->data,
                'currency'=>$request->currency,
                'type'=>$request->type,
                'description'=>$request->description,
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
        Pricing::find($id)->delete();
        return response()->json([
            'status'=>200,
            'message'=>__("backend/validation.delete"),
        ]);
    }

}
