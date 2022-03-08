<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Certificates;
use App\Models\Courses;
use Illuminate\Http\Request;



class CertificatesCountroller extends Controller
{

    public function index()
    {
        $Certificates = Certificates::all();
        return view('backend.pages.Certificates.index',compact('Certificates'));
    }

    public function create()
    {
        $Courses = Courses::all();
        return view('backend.pages.Certificates.create',compact('Courses'));
    }

    public function store(Request $request)
    {
        // start validation
        $request->validate([
            'serial' =>'required|not_regex:<script>',
            'from_date' => 'required',
            'to_date' => 'required',
            'grade' => 'required',
            'image'=>'mimes:jpeg,png,jpg,pdf',
            'courses_id' => 'required',
        ],[
            'serial.required' =>'برجاء ادخال سيريال  ',
            'from_date.required' => 'برجاء ادخال  التاريخ من ',
            'to_date.required' => 'برجاء ادخالي التاريخ الي',
            'grade.required' => 'برجاء ادخال  النسبة  ',
            'image.required' => 'برجاء ادخال الصورة',
            'courses_id.required' => 'برجاء ادخال  الكورس ',
        ]);
        // end validation

        if($request->file('image'))
        {

            // start image
            $image = $request->file('image');
            $name_gen = hexdec(uniqid());
            $img_ext = strtolower($image->getClientOriginalExtension());
            $img_name = $name_gen.'.'.$img_ext;
            $up_location = 'upload/backend/Certificates/';
            $save_url = $img_name;
            $image->move($up_location,$img_name);
            // end image

            // start create
            Certificates::create([
                'serial' => $request->serial,
                'from_date' => $request->from_date,
                'to_date' => $request->to_date,
                'grade' => $request->grade,
                'image' => $save_url,
                'courses_id' => $request->courses_id,
            ]);
            // end create


        }else{
            // start create
            Certificates::create([
                'serial' => $request->serial,
                'from_date' => $request->from_date,
                'to_date' => $request->to_date,
                'grade' => $request->grade,
                'image' =>'no image',
                'courses_id' => $request->courses_id,
            ]);
            // end create

        }
        session()->flash('Add', 'تم اضافة الشهادة بنجاح ');
        return redirect('admin/Certificates');
    }

    public function edit($id)
    {
        $Certificates = Certificates::findorFail($id);
        $Courses = Courses::all();
        return view('backend.pages.Certificates.edit',compact('Certificates','Courses'));
    }

    public function update(Request $request)
    {
        $id = $request->id;

        // start validation
        $request->validate([
            'serial' =>'required',
            'from_date' => 'required',
            'to_date' => 'required',
            'grade' => 'required',
            'image'=>'mimes:jpeg,png,jpg,pdf',
            'courses_id' => 'required',
        ],[
            'serial.required' =>'برجاء ادخال سيريال  ',
            'from_date.required' => 'برجاء ادخال  التاريخ من ',
            'to_date.required' => 'برجاء ادخالي التاريخ الي',
            'grade.required' => 'برجاء ادخال  النسبة  ',
            'image.required' => 'برجاء ادخال الصورة',
            'courses_id.required' => 'برجاء ادخال  الكورس ',
        ]);
        // end validation

        $old_image = $request->old_image;


        $brand_image = $request->file('image');
        if($brand_image)
        {
            // start image
            $image = $request->file('image');
            $name_gen = hexdec(uniqid());
            $img_ext = strtolower($image->getClientOriginalExtension());
            $img_name = $name_gen.'.'.$img_ext;
            $up_location = 'upload/backend/Certificates/';
            $save_url = $img_name;
            $image->move($up_location,$img_name);
            // end image

            if(file_exists($old_image))
            {
                unlink(Certificates::IMAGE_PATH.$old_image);
            }

            // start update
            Certificates::find($id)->update([
                'serial' => $request->serial,
                'from_date' => $request->from_date,
                'to_date' => $request->to_date,
                'grade' => $request->grade,
                'image' => $save_url,
                'courses_id' => $request->courses_id,
            ]);
        }else{
            Certificates::find($id)->update([
                'serial' => $request->serial,
                'from_date' => $request->from_date,
                'to_date' => $request->to_date,
                'grade' => $request->grade,
                'image' => $old_image,
                'courses_id' => $request->courses_id,
                // end update
            ]);
        }

        session()->flash('Add', 'تم  تعديل  الشهادة بنجاح ');
        return redirect('admin/Certificates');
    }

    public function destroy(Request $request)
    {
        try {

            $delete = Certificates::find($request->invoice_id);
            $old_image = $delete->image;
            if($old_image)
            {
                if(file_exists($old_image))
                {
                    unlink(Certificates::IMAGE_PATH.$old_image);
                }

                $delete->delete();
            }
            session()->flash('Deleted', 'تم حذف الشهادة بنجاح');
            return redirect()->back();

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

}
