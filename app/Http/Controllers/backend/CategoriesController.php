<?php

namespace App\Http\Controllers\backend;
use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Repository\CategoryRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Image;
use Carbon\Carbon;

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
        $Categories = $this->RepositoryCategory->all();
        $ConsteCategory =Categories::IMAGE_PATH;
        $url = env('APP_URL');
        // dd($a);
        return response()->json([
            'Categories'=>$Categories,
            'ConsteCategory'=>$ConsteCategory,
            'url'=>$url,
        ]);
    }

    public function create()
    {
        return view('backend.pages.Categories.create');
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name'=> 'required',
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
                'name'=>$request->name,
                'image'=>$save_url,
                'created_at'=>Carbon::now(),
            ]);

            return response()->json([
                'status'=>200,
                'message'=>'success add data Categories',
            ]);
        }


    }

    public function edit($id)
    {
        $Categories = $this->RepositoryCategory->get($id);

        if($Categories)
        {
            $ConsteCategory =Categories::IMAGE_PATH;
            $url = env('APP_URL');
            return response()->json([
                'status'=>200,
                'Categories'=> $Categories,
                'ConsteCategory'=>$ConsteCategory,
                'url'=>$url,
            ]);
        }
        else
        {
            return response()->json([
                'status'=>404,
                'message'=>'not found data.'
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
                    'message'=>'success update data',
                ]);

            }else{

                $this->RepositoryCategory->update($id,[
                    'name'=> $request->name,
                    'image'=>$old_image,
                    'created_at'=>Carbon::now(),
                   ]);

                return response()->json([
                    'status'=>200,
                    'message'=>'success update data',
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
                    'message'=>'Categories Deleted Successfully.'
                ]);

            }else{
                return response()->json([
                    'status'=>404,
                    'message'=>'No Student Found.'
                ]);
            }

    }

}
