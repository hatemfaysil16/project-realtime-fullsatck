<?php

namespace App\Http\Controllers\backend;
use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Repository\ServicesRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Image;
use Carbon\Carbon;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


class ServicesController extends Controller
{
    // ServicesRepository
    protected $ServicesRepository;
    public function __construct(ServicesRepository $ServicesRepository)
    {
        $this->ServicesRepository = $ServicesRepository;
    }

    public function index()
    {
        return view('backend.pages.Service.index');
    }

    public function fetchData()
    {
        $AllData = $this->ServicesRepository->all();

        $ConstImage =Service::IMAGE_PATH;
        $url = env('APP_URL');
        $LocalizationCurrent = LaravelLocalization::getCurrentLocale();
        return response()->json([
            'AllData'=>$AllData,
            'ConstImage'=>$ConstImage,
            'url'=>$url,
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
            'image'=> 'required',
        ]);


        if($validator->fails())
        {
            return response()->json([
                'status'=>400,
                'errors'=>$validator->messages()
            ]);

        }else{

            if($request->hasFile('image'))
            {
                $image = $request->file('image');
                $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
                Image::make($image)->resize(300,300)->Save(public_path(Service::IMAGE_PATH.$name_gen));
                $save_url = $name_gen;
            }

            $this->ServicesRepository->store([
                'name'=>['ar'=>$request->name_ar,'en'=>$request->name_en],
                'description'=>['ar'=>$request->description_ar,'en'=>$request->description_en],
                'image'=>$save_url,
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
        $dataFind = $this->ServicesRepository->get($id);

        if($dataFind)
        {
            $ConstImage =Service::IMAGE_PATH;
            $url = env('APP_URL');
            $LocalizationCurrent = LaravelLocalization::getCurrentLocale();
            return response()->json([
                'status'=>200,
                'dataFind'=> $dataFind,
                'ConstImage'=>$ConstImage,
                'url'=>$url,
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
            'image'=> '',
        ]);


        if($validator->fails())
        {
            return response()->json([
                'status'=>400,
                'errors'=>$validator->messages()
            ]);

        }else{


           // start old_image
            $old_image = $request->old_image;
            // end old_image


            $brand_image = $request->hasFile('image');
            if ($brand_image) {
                $image = $request->file('image');
                $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
                Image::make($image)->resize(300, 300)->Save(public_path(Service::IMAGE_PATH.$name_gen));
                $save_url = $name_gen;


                if (file_exists(public_path(Service::IMAGE_PATH.$request->old_image))) {
                    unlink(public_path(Service::IMAGE_PATH.$request->old_image));
                }

                $this->ServicesRepository->update($id,[
                    'name'=> $request->name,
                    'description'=> $request->description,
                    'active'=>($request->active_ss?1:0),
                    'image'=>$save_url,
                    'created_at'=>Carbon::now(),
                   ]);



                return response()->json([
                    'status'=>200,
                    'message'=>__("backend/validation.update"),
                ]);

            }else{

                $this->ServicesRepository->update($id,[
                    'name'=> $request->name,
                    'description'=> $request->description,
                    'active'=>($request->active?'1':'0'),
                    'image'=>$old_image,
                    'created_at'=>Carbon::now(),
                   ]);

                return response()->json([
                    'status'=>200,
                    'message'=>__("backend/validation.update"),
                ]);
            }




        }

    }

    public function destroy($id)
    {
            $delete = Service::find($id);
            if($delete)
            {
                $old_image = $delete->image;
                if (file_exists(public_path(Service::IMAGE_PATH.$old_image))) {
                    unlink(public_path(Service::IMAGE_PATH.$old_image));
                }
                $delete->delete();
                return response()->json([
                    'status'=>200,
                    'message'=>__("backend/validation.delete"),
                ]);


            }else{
                return response()->json([
                    'status'=>404,
                    'message'=>__("backend/validation.notFound"),
                ]);
            }

    }

}
