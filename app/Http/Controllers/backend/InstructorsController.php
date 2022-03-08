<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Instructors;
use App\Models\User;
use Illuminate\Http\Request;
use Image;


class InstructorsController extends Controller
{

    public function index()
    {
        $instructors = Instructors::all();
        return view('backend.pages.Instructors.index',compact('instructors'));
    }

    public function create()
    {
        $user = User::all();
        return view('backend.pages.Instructors.create',compact('user'));
    }

    public function store(Request $request)
    {

        // start validation
        $request->validate([
            'name' =>'required|not_regex:<script>|max:220|min:3',
            'title' => 'required|not_regex:<script>|max:220|min:3',
            'birthday' => 'required|not_regex:<script>',
            'email' => 'required|not_regex:<script>|max:50|min:3',
            'cert_no' => 'required|not_regex:<script>|max:500',
            'description' => 'required|not_regex:<script>',
            'experience' => 'required|not_regex:<script>',
            'specialty' => 'required|not_regex:<script>',
            'education' => 'required|not_regex:<script>',
            'image'=>'required|mimes:jpeg,png,jpg',
            ],[
            'name.required' =>'برجاء ادخال الاسم ',
            'title.required' => 'برجاء ادخال  مسمي الوظيفي',
            'email.required' => 'برجاء ادخالي البريدالالكتروني',
            'birthday.required' => 'برجاء ادخال  عيد الميلاد ',
            'cert_no.required' => 'برجاء ادخال الشهادة',
            'description.required' => 'برجاء ادخال  وصف ',
            'experience.required' => 'برجاء ادخال الخبرة ',
            'specialty.required' => 'برجاء ادخال تخصص ',
            'education.required' => 'برجاء ادخال مرحلة التعليم ',
            'image.required'=>'برجاء ادخال الصور',
        ]);
        // end validation

        if($request->file('image'))
        {

          // start image
            $image = $request->file('image');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(300,300)->Save('upload/backend/instructors/'.$name_gen);
            $save_url = $name_gen;
          // end image

          // start create
            Instructors::create([
                'name' => $request->name,
                'title' => $request->title,
                'birthday' => $request->birthday,
                'email' => $request->email,
                'cert_no' => $request->cert_no,
                'description' => $request->description,
                'experience' => $request->experience,
                'specialty' => $request->specialty,
                'education' => $request->specialty,
                'user_id'=>$request->user_id,
                'image'=>$save_url,
            ]);

        }else{
            Instructors::create([
                'name' => $request->name,
                'title' => $request->title,
                'birthday' => $request->birthday,
                'email' => $request->email,
                'cert_no' => $request->cert_no,
                'description' => $request->description,
                'experience' => $request->experience,
                'specialty' => $request->specialty,
                'education' => $request->specialty,
                'user_id'=>$request->user_id,
                'image'=>'no image',
            ]);
        }
        // end create
        session()->flash('Add', 'تم اضافة المدرب بنجاح ');
        return redirect('admin/Instructors');
    }

    public function edit($id)
    {
        $instructors = Instructors::findorFail($id);
        $users = User::all();
        return view('backend.pages.Instructors.edit',compact('instructors','users'));
    }

    public function update(Request $request)
    {
        $id = $request->id;
        // start validation
        $request->validate([
            'name' =>'required|not_regex:<script>|max:220|min:3',
            'title' => 'required|not_regex:<script>|max:220|min:3',
            'birthday' => 'required|not_regex:<script>',
            'email' => 'required|not_regex:<script>|max:220|min:3',
            'cert_no' => 'required|not_regex:<script>|max:220',
            'description' => 'required|not_regex:<script>',
            'experience' => 'required|not_regex:<script>',
            'specialty' => 'required|not_regex:<script>',
            'education' => 'required|not_regex:<script>',
            'image'=>'mimes:jpeg,png,jpg',
            ],[
            'name.required' =>'برجاء ادخال الاسم ',
            'title.required' => 'برجاء ادخال  مسمي الوظيفي',
            'email.required' => 'برجاء ادخالي البريدالالكتروني',
            'birthday.required' => 'برجاء ادخال  عيد الميلاد ',
            'cert_no.required' => 'برجاء ادخال الشهادة',
            'description.required' => 'برجاء ادخال  وصف ',
            'experience.required' => 'برجاء ادخال الخبرة ',
            'specialty.required' => 'برجاء ادخال تخصص ',
            'education.required' => 'برجاء ادخال مرحلة التعليم ',
            'image.required'=>'برجاء ادخال الصور',
        ]);
        // end validation

             // start old_image
            $old_image = $request->old_image;
             // end old_image


            $brand_image = $request->file('image');
            if($brand_image)
            {
             // start image
                $image = $request->file('image');
                $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
                Image::make($image)->resize(300,300)->Save('upload/backend/instructors/'.$name_gen);
                $save_url = $name_gen;
             // end image

             // start delete image
             if(file_exists($old_image))
             {
                unlink(Instructors::IMAGE_PATH.$old_image);
             }
             // end delete image


             // start update
                Instructors::find($id)->update([
                    'name' => $request->name,
                    'title' => $request->title,
                    'birthday' => $request->birthday,
                    'email' => $request->email,
                    'cert_no' => $request->cert_no,
                    'description' => $request->description,
                    'experience' => $request->experience,
                    'specialty' => $request->specialty,
                    'education' => $request->specialty,
                    'user_id'=>$request->user_id,
                    'image'=>$save_url,
                ]);
            }else{
                Instructors::find($id)->update([
                    'name' => $request->name,
                    'title' => $request->title,
                    'birthday' => $request->birthday,
                    'email' => $request->email,
                    'cert_no' => $request->cert_no,
                    'description' => $request->description,
                    'experience' => $request->experience,
                    'specialty' => $request->specialty,
                    'education' => $request->specialty,
                    'user_id'=>$request->user_id,
                    'image'=>$old_image,
                ]);
            // end update
            }

            session()->flash('Add', 'تم  تعديل  المدرب بنجاح ');
            return redirect('admin/Instructors');
    }

    public function destroy(Request $request)
    {
        try {

            $delete = Instructors::find($request->invoice_id);
            $old_image = $delete->image;
            $a = ($old_image);
            if($old_image)
            {

              if(file_exists($old_image))
              {
                unlink(Instructors::IMAGE_PATH.$old_image);
              }

              $delete->delete();
            }
                session()->flash('Deleted', 'تم حذف المدرب بنجاح');
            return redirect()->back();

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

}
