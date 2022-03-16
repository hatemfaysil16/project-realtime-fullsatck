<?php

namespace App\Http\Controllers\backend;
use App\Http\Controllers\Controller;
use App\Models\Features;
use App\Repository\FeaturesRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


class FeaturesController extends Controller
{
    // FeaturesRepository
    protected $FeaturesRepository;
    public function __construct(FeaturesRepository $FeaturesRepository)
    {
        $this->FeaturesRepository = $FeaturesRepository;
    }

    public function index()
    {
        return view('backend.pages.Features.index');
    }

    public function fetchData()
    {
        $AllData = $this->FeaturesRepository->all();

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
            'fontAwesome'=> 'required',
        ]);


        if($validator->fails())
        {
            return response()->json([
                'status'=>400,
                'errors'=>$validator->messages()
            ]);

        }else{

            $this->FeaturesRepository->store([
                'name'=>['ar'=>$request->name_ar,'en'=>$request->name_en],
                'fontAwesome'=>$request->fontAwesome,
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
        $dataFind = $this->FeaturesRepository->get($id);

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
        // dd($request);
        $validator = Validator::make($request->all(), [
            'name'=> 'required',
            'fontAwesome'=> 'required',

        ]);


        if($validator->fails())
        {
            return response()->json([
                'status'=>400,
                'errors'=>$validator->messages()
            ]);

        }else{


            $this->FeaturesRepository->update($id,[
                'name'=> $request->name,
                'fontAwesome'=> $request->fontAwesome,
                'active'=>($request->active_ss?1:0),
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
        Features::find($id)->delete();
        return response()->json([
            'status'=>200,
            'message'=>__("backend/validation.delete"),
        ]);
    }

}
