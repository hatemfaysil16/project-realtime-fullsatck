<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Serves;
use Illuminate\Http\Request;
use Image;

class ServesController extends Controller
{

    public function index()
    {
        $Serves = Serves::all();
        return view('backend.pages.Serves.index',compact('Serves'));
    }

    public function create()
    {
        return view('backend.pages.Serves.create');
    }

    public function store(Request $request)
    {
        // start validation
        $request->validate([
            'image'=>'required|mimes:jpeg,png,jpg',
            'name' => 'required|not_regex:<script>',
            'description' => 'required|not_regex:<script>',
            'fullDescription' => 'required|not_regex:<script>',
            'price' => 'required|not_regex:<script>',
            'active'=>'required|not_regex:<script>|boolean',
            ],[
            'image.required' =>'برجاء ادخال الصورة ',
            'name.required' =>'برجاء ادخال الاسم ',
            'description.required' => ' برجاء ادخال وصف',
            'fullDescription.required' => 'برجاء ادخال الوصف الكامل',
            'price.required'=>'برجاء ادخال  السعر  ',
            'active.required'=>'برجاء ادخال نشط او غير نشط',
        ]);
        // end validation


        if($request->file('image'))
        {
            // start image
            $image = $request->file('image');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(300,300)->Save('upload/backend/Serves/'.$name_gen);
            $save_url = $name_gen;
            // end image

            // start create
            Serves::create([
                'image'=>$save_url,
                'name' =>$request->name,
                'description' =>$request->description,
                'fullDescription' =>$request->fullDescription,
                'price' => $request->price,
                'active'=>$request->active,
            ]);

        }else{
            Serves::create([
                'image'=>'no image',
                'name' =>$request->name,
                'description' =>$request->description,
                'fullDescription' =>$request->fullDescription,
                'price' => $request->price,
                'active'=>$request->active,
            ]);
            // end create
        }


        // start create

        // end create

        session()->flash('Add', 'تم اضافة الخدمات  بنجاح ');
        return redirect('admin/Serves');
    }

    public function edit($id)
    {
        $Serves = Serves::findorFail($id);
        return view('backend.pages.Serves.edit',compact('Serves'));
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $request->validate([
            'image'=>'mimes:jpeg,png,jpg',
            'name' => 'required|not_regex:<script>',
            'description' => 'required|not_regex:<script>',
            'fullDescription' => 'required|not_regex:<script>',
            'price' => 'required|not_regex:<script>',
            'active'=>'required|not_regex:<script>|boolean',
            ],[
            'image.required' =>'برجاء ادخال الصورة ',
            'name.required' =>'برجاء ادخال الاسم ',
            'description.required' => ' برجاء ادخال وصف',
            'fullDescription.required' => 'برجاء ادخال الوصف الكامل',
            'price.required'=>'برجاء ادخال  السعر  ',
            'active.required'=>'برجاء ادخال نشط او غير نشط',
        ]);


            $old_image = $request->old_image;

            $brand_image = $request->file('image');
            if($brand_image)
            {
                // start image
                $image = $request->file('image');
                $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
                Image::make($image)->resize(300,300)->Save('upload/backend/Serves/'.$name_gen);
                $save_url = $name_gen;
                // end image

                // start delet image
                if(file_exists($old_image))
                {
                    unlink(Serves::IMAGE_PATH.$old_image);
                }
                // end delet image

                // start update
                Serves::find($id)->update([
                    'image'=>$save_url,
                    'name' =>$request->name,
                    'description' =>$request->description,
                    'fullDescription' =>$request->fullDescription,
                    'price' => $request->price,
                    'active'=>$request->active,
                ]);
            }else{
                Serves::find($id)->update([
                    'image'=>$old_image,
                    'name' =>$request->name,
                    'description' =>$request->description,
                    'fullDescription' =>$request->fullDescription,
                    'price' => $request->price,
                    'active'=>$request->active,
                ]);
                // end update

            }

            session()->flash('Add', 'تم  تعديل  الخدمات بنجاح ');
            return redirect('admin/Serves');
    }

    public function destroy(Request $request)
    {
        try {

            $delete = Serves::find($request->invoice_id);
            $old_image = $delete->image;
            if($old_image)
            {
              if(file_exists($old_image))
              {
                unlink(Serves::IMAGE_PATH.$old_image);
              }
              $delete->delete();
            }
                session()->flash('Deleted', 'تم حذف الخدمات بنجاح');
            return redirect()->back();

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

}
