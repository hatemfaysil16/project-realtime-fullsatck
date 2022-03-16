<?php

namespace App\Http\Controllers\backend;
use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use App\Repository\AboutUsRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


class AboutUsController extends Controller
{
    // AboutUsRepository
    protected $AboutUsRepository;
    public function __construct(AboutUsRepository $AboutUsRepository)
    {
        $this->AboutUsRepository = $AboutUsRepository;
    }

    public function index()
    {
        return view('backend.pages.AboutUs.index');
    }

    public function fetchData()
    {
        $AllData = $this->AboutUsRepository->all();

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
            'description_ar'=> 'required',
            'description_en'=> 'required',
            'fullDescription_ar'=> 'required',
            'fullDescription_en'=> 'required',
        ]);


        if($validator->fails())
        {
            return response()->json([
                'status'=>400,
                'errors'=>$validator->messages()
            ]);

        }else{

            $this->AboutUsRepository->store([
                'name'=>['ar'=>$request->name_ar,'en'=>$request->name_en],
                'description'=>['ar'=>$request->description_ar,'en'=>$request->description_en],
                'fullDescription'=>['ar'=>$request->fullDescription_ar,'en'=>$request->fullDescription_en],
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
        $dataFind = $this->AboutUsRepository->get($id);

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
            'description'=> 'required',
            'fullDescription'=> 'required',

        ]);


        if($validator->fails())
        {
            return response()->json([
                'status'=>400,
                'errors'=>$validator->messages()
            ]);

        }else{


            $this->AboutUsRepository->update($id,[
                'name'=> $request->name,
                'description'=> $request->description,
                'fullDescription'=> $request->fullDescription,
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
        AboutUs::find($id)->delete();
        return response()->json([
            'status'=>200,
            'message'=>__("backend/validation.delete"),
        ]);
    }

}
