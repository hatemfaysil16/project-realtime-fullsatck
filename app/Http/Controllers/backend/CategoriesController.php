<?php

namespace App\Http\Controllers\backend;
use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Repository\CategoryRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Image;
use Carbon\Carbon;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class CategoriesController extends Controller
{
    // CategoryRepository
    protected $RepositoryCategory;
    public function __construct(CategoryRepository $RepositoryCategory)
    {
        $this->RepositoryCategory = $RepositoryCategory;
    }

    public function index()
    {
        return view('backend.pages.Categories.index');
    }

    public function fetchData()
    {
        $AllData = $this->RepositoryCategory->all();

        $ConstImage =Categories::IMAGE_PATH;
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
                Image::make($image)->resize(300,300)->Save(public_path(Categories::IMAGE_PATH.$name_gen));
                $save_url = $name_gen;
            }

            $this->RepositoryCategory->store([
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

        // success add data Categories
    }

    public function edit($id)
    {
        $dataFind = $this->RepositoryCategory->get($id);

        if($dataFind)
        {
            $ConstImage =Categories::IMAGE_PATH;
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
                Image::make($image)->resize(300, 300)->Save(public_path(Categories::IMAGE_PATH.$name_gen));
                $save_url = $name_gen;


                if (file_exists(public_path(Categories::IMAGE_PATH.$request->old_image))) {
                    unlink(public_path(Categories::IMAGE_PATH.$request->old_image));
                }

                $this->RepositoryCategory->update($id,[
                    'name'=> $request->name,
                    'image'=>$save_url,
                    'created_at'=>Carbon::now(),
                   ]);


                return response()->json([
                    'status'=>200,
                    'message'=>__("backend/validation.update"),
                ]);

            }else{

                $this->RepositoryCategory->update($id,[
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
            $delete = Categories::find($id);
            if($delete)
            {
                $old_image = $delete->image;
                if (file_exists(public_path(Categories::IMAGE_PATH.$old_image))) {
                    unlink(public_path(Categories::IMAGE_PATH.$old_image));
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
