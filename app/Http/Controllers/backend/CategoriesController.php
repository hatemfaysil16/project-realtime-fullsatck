<?php

namespace App\Http\Controllers\backend;
use App\Http\Controllers\Controller;
use App\Models\Categories;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Image;


class CategoriesController extends Controller
{

    public function index()
    {
        return view('backend.pages.Categories.index');
    }

    public function fetchData()
    {
        $Categories = Categories::all();
        return response()->json([
            'Categories'=>$Categories,
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


            $student = new Categories;
            $student->name = $request->input('name');
            $student->image = $save_url;
            $student->save();
            return response()->json([
                'status'=>200,
                'message'=>'success add data',
            ]);
        }


    }


    public function edit($id)
    {
        $Categories = Categories::find($id);
        if($Categories)
        {
            return response()->json([
                'status'=>200,
                'Categories'=> $Categories,
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

                Categories::find($id)->update([
                    'name'=> $request->name,
                    'image'=>$save_url,
                    'created_at'=>Carbon::now(),
                    ]);

                return response()->json([
                    'status'=>200,
                    'message'=>'success update data',
                ]);

            }else{
                Categories::find($id)->update([
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
