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
        $Categories = Categories::all();
        return view('backend.pages.Categories.index',compact('Categories'));
    }

    public function create()
    {
        return view('backend.pages.Categories.create');
    }


    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name'=> 'required',
        ]);


        if($validator->fails())
        {
            // dd('field');
            return response()->json([
                'status'=>400,
                'errors'=>$validator->messages()
            ]);

        }else{
            // dd('success');
            // $student = new Student;
            // $student->name = $request->input('name');
            // $student->course = $request->input('course');
            // $student->email = $request->input('email');
            // $student->phone = $request->input('phone');
            // $student->save();
            return response()->json([
                'status'=>200,
                'message'=>'Student Added Successfully.'
            ]);
        }


    }

    
    // public function stores(Request $request)
    // {
    //     // start valdation
    //     $request->validate([
    //         'name' =>'required|not_regex:<script>',
    //         'image'=>'required|mimes:pdf,jpeg,png,jpg',
    //         ],[
    //             'name.required' =>'برجاء ادخال الاسم ',
    //             'image.required'=>'برجاء ادخال الصور',
    //         ]);
    //     // end valdation



    //     if($request->file('image'))
    //     {
    //         // start image
    //         $image = $request->file('image');
    //         $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
    //         Image::make($image)->resize(300,300)->Save('upload/backend/Categories/'.$name_gen);
    //         $save_url = $name_gen;
    //         // end image

    //         // start create
    //         Categories::create([
    //             'name' => $request->name,
    //             'image'=>$save_url,
    //         ]);

    //     }else{
    //         Categories::create([
    //             'name' => $request->name,
    //             'image'=>'no image',
    //         ]);
    //         // end create
    //     }
    //     session()->flash('Add', 'تم اضافة الفئة بنجاح ');
    //     return redirect('admin/Categories');
    // }

    public function edit($id)
    {
        $Categories = Categories::findorFail($id);
        return view('backend.pages.Categories.edit',compact('Categories'));
    }

    public function update(Request $request)
    {
        $id = $request->id;
        // start valdation
        $validate = $request->validate([
            'name'=>'required|not_regex:<script>',
            'image'=>'mimes:pdf,jpeg,png,jpg',
        ],
        [
            'name.required'=>'Please Input About name',
            'image.required'=>'برجاء ادخال الصور',
        ]);
        // end valdation

        // start old_image
            $old_image = $request->old_image;
        // end old_image


            $brand_image = $request->file('image');
            if($brand_image)
            {
                // start image
                $image = $request->file('image');
                $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
                Image::make($image)->resize(300,300)->Save('upload/backend/Categories/'.$name_gen);
                $save_url = $name_gen;
                // end image

                // start delete image
                if(file_exists($save_url))
                {
                    unlink(Categories::IMAGE_PATH.$old_image);
                }
                // end delete image


               // start update
               Categories::find($id)->update([
                'name'=> $request->name,
                'image'=>$save_url,
                'created_at'=>Carbon::now(),
                ]);
              }else{
                Categories::find($id)->update([
                    'name'=> $request->name,
                    'image'=>$old_image,
                    'created_at'=>Carbon::now(),
                ]);
               // end update
            }

        session()->flash('Add', 'تم  تعديل  الفئة بنجاح ');
        return redirect('admin/Categories');
    }

    public function destroy(Request $request)
    {
        try {
            $delete = Categories::find($request->invoice_id);
            $old_image = $delete->image;


            if($old_image)
            {

                if(file_exists($old_image))
                {
                    unlink(Categories::IMAGE_PATH.$old_image);
                }

              $delete->delete();
            }
                session()->flash('Deleted', 'تم حذف الفئة بنجاح');
            return redirect()->back();

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

}
