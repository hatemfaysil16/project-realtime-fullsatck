<?php

namespace App\Http\Controllers\backend;
use App\Http\Controllers\Controller;
use App\Models\Logo;
use App\Repository\LogoRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Image;
use Carbon\Carbon;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class LogoController extends Controller
{
    // LogoRepository
    protected $LogoRepository;
    public function __construct(LogoRepository $LogoRepository)
    {
        $this->LogoRepository = $LogoRepository;
    }

    public function index()
    {
        return view('backend.pages.Logo.index');
    }

    public function fetchData()
    {
        $AllData = $this->LogoRepository->all();

        $ConstImage =Logo::IMAGE_PATH;
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
                Image::make($image)->resize(300,300)->Save(public_path(Logo::IMAGE_PATH.$name_gen));
                $save_url = $name_gen;
            }

            $this->LogoRepository->store([
                'name'=>['ar'=>$request->name_ar,'en'=>$request->name_en],
                'image'=>$save_url,
                'active'=>($request->active?1:0),
                'created_at'=>Carbon::now(),
            ]);

            return response()->json([
                'status'=>200,
                'message'=>__("backend/validation.store") ,
            ]);
        }

        // success add data Logo
    }

    public function edit($id)
    {
        $dataFind = $this->LogoRepository->get($id);

        if($dataFind)
        {
            $ConstImage =Logo::IMAGE_PATH;
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
        $validator = Validator::make($request->all(), [
            'name'=> 'required',
            'image'=>'mimes:pdf,jpeg,png,jpg',
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
                Image::make($image)->resize(300, 300)->Save(public_path(Logo::IMAGE_PATH.$name_gen));
                $save_url = $name_gen;


                if (file_exists(public_path(Logo::IMAGE_PATH.$request->old_image))) {
                    unlink(public_path(Logo::IMAGE_PATH.$request->old_image));
                }

                $this->LogoRepository->update($id,[
                    'name'=> $request->name,
                    'image'=>$save_url,
                    'created_at'=>Carbon::now(),
                   ]);


                return response()->json([
                    'status'=>200,
                    'message'=>__("backend/validation.update"),
                ]);

            }else{

                $this->LogoRepository->update($id,[
                    'name'=> $request->name,
                    'image'=>$old_image,
                    'active'=>($request->active_ss?1:0),
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
            $delete = Logo::find($id);
            if($delete)
            {
                $old_image = $delete->image;
                if (file_exists(public_path(Logo::IMAGE_PATH.$old_image))) {
                    unlink(public_path(Logo::IMAGE_PATH.$old_image));
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
