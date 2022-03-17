<?php

namespace App\Http\Controllers\backend;
use App\Http\Controllers\Controller;
use App\Models\Map;
use App\Repository\MapRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


class MapController extends Controller
{
    // MapRepository
    protected $MapRepository;
    public function __construct(MapRepository $MapRepository)
    {
        $this->MapRepository = $MapRepository;
    }

    public function index()
    {
        return view('backend.pages.map.index');
    }

    public function fetchData()
    {
        $AllData = $this->MapRepository->all();

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
            'iframe'=> 'required',
        ]);


        if($validator->fails())
        {
            return response()->json([
                'status'=>400,
                'errors'=>$validator->messages()
            ]);

        }else{

            $this->MapRepository->store([
                'name'=>['ar'=>$request->name_ar,'en'=>$request->name_en],
                'iframe'=>$request->iframe,
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
        $dataFind = $this->MapRepository->get($id);

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
            'iframe'=> 'required',

        ]);


        if($validator->fails())
        {
            return response()->json([
                'status'=>400,
                'errors'=>$validator->messages()
            ]);

        }else{


            $this->MapRepository->update($id,[
                'name'=> $request->name,
                'iframe'=> $request->iframe,
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
        Map::find($id)->delete();
        return response()->json([
            'status'=>200,
            'message'=>__("backend/validation.delete"),
        ]);
    }

}
