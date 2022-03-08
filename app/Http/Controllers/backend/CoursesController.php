<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\Courses;
use App\Models\Instructors;
use Illuminate\Http\Request;
use Image;

class CoursesController extends Controller
{

    public function index()
    {
        $Courses = Courses::all();
        return view('backend.pages.Courses.index',compact('Courses'));
    }

    public function create()
    {
        $Instructors = Instructors::all();
        $Categories = Categories::all();
        return view('backend.pages.Courses.create',compact('Instructors','Categories'));
    }

    public function store(Request $request)
    {
        // return $request;die;
        // start validation
        $request->validate([
            'image'=>'required|mimes:jpeg,png,jpg',
            'lectures' => 'required|not_regex:<script>',
            'name' => 'required|not_regex:<script>',
            'duration' => 'required|not_regex:<script>',
            'level' => 'required|not_regex:<script>',
            'language' => 'required|not_regex:<script>|max:2',
            'assessments' => 'required|not_regex:<script>|boolean',
            'description' => 'required|not_regex:<script>',
            'certification' => 'required|not_regex:<script>',
            'fullDescription' => 'required|not_regex:<script>',
            'price' => 'required|not_regex:<script>',
            'active'=>'required|not_regex:<script>|boolean',
            'instructor_id'=>'required|not_regex:<script>',
            'categories_id'=>'required|not_regex:<script>',
            ],[
            'image.required' =>'برجاء ادخال الصورة ',
            'name.required' =>'برجاء ادخال الاسم ',
            'lectures.required' => 'برجاء ادخال المقال',
            'duration.required' => 'برجاء ادخال المدة الزمنية ',
            'level.required' => 'برجاء ادخال حالة المرحلة',
            'language.required' => 'برجاء ادخال اللغة',
            'assessments.required' => 'برجاء ادخال التقييمات',
            'description.required' => ' برجاء ادخال وصف',
            'certification.required' => 'برجاء ادخال الشهادة',
            'fullDescription.required' => 'برجاء ادخال الوصف الكامل',
            'price.required'=>'برجاء ادخال  السعر  ',
            'active.required'=>'برجاء ادخال نشط او غير نشط',
            'instructor_id.required'=>'برجاء ادخال كورس',
            'categories_id.required'=>'برجاء ادخال كاتيجري الخاص بة',
        ]);
        // end validation


        if($request->file('image'))
        {

        // start image
            $image = $request->file('image');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(300,300)->Save('upload/backend/Courses/'.$name_gen);
            $save_url = $name_gen;
        // end image


        // start create
            Courses::create([
                'image'=>$save_url,
                'name' =>$request->name,
                'lectures' =>$request->lectures,
                'duration' =>$request->duration,
                'level' => $request->level,
                'language' =>$request->language,
                'assessments' => $request->assessments,
                'description' =>$request->description,
                'certification' => $request->certification,
                'price' => $request->price,
                'fullDescription' =>$request->fullDescription,
                'active'=>$request->active,
                'instructor_id'=>$request->instructor_id,
                'categories_id'=>$request->categories_id,
            ]);

        }else{
            Courses::create([
                'image'=>'no image',
                'name' =>$request->name,
                'lectures' =>$request->lectures,
                'duration' =>$request->duration,
                'level' => $request->level,
                'language' =>$request->language,
                'assessments' => $request->assessments,
                'description' =>$request->description,
                'certification' => $request->certification,
                'price' => $request->price,
                'fullDescription' =>$request->fullDescription,
                'active'=>$request->active,
                'instructor_id'=>$request->instructor_id,
                'categories_id'=>$request->categories_id,
            ]);
        }
        // end create
        session()->flash('Add', 'تم اضافة الكورس بنجاح ');
        return redirect('admin/Courses');
    }

    public function edit($id)
    {
        $Courses = Courses::findorFail($id);
        $Instructors = Instructors::all();
        $Categories = Categories::all();
        return view('backend.pages.Courses.edit',compact('Courses','Instructors','Categories'));
    }

    public function update(Request $request)
    {
        $id = $request->id;
        // start validation
        $request->validate([
            'image'=>'mimes:jpeg,png,jpg',
            'lectures' => 'required|not_regex:<script>',
            'name' => 'required|not_regex:<script>',
            'duration' => 'required|not_regex:<script>',
            'level' => 'required|not_regex:<script>',
            'language' => 'required|not_regex:<script>|max:2',
            'assessments' => 'required|not_regex:<script>|boolean',
            'description' => 'required|not_regex:<script>',
            'certification' => 'required|not_regex:<script>',
            'fullDescription' => 'required|not_regex:<script>',
            'price' => 'required|not_regex:<script>',
            'active'=>'required|not_regex:<script>|boolean',
            'instructor_id'=>'required|not_regex:<script>',
            'categories_id'=>'required|not_regex:<script>',
            ],[
            'image.required' =>'برجاء ادخال الصورة ',
            'name.required' =>'برجاء ادخال الاسم ',
            'lectures.required' => 'برجاء ادخال المقال',
            'duration.required' => 'برجاء ادخال المدة الزمنية ',
            'level.required' => 'برجاء ادخال حالة المرحلة',
            'language.required' => 'برجاء ادخال اللغة',
            'assessments.required' => 'برجاء ادخال التقييمات',
            'description.required' => ' برجاء ادخال وصف',
            'certification.required' => 'برجاء ادخال الشهادة',
            'fullDescription.required' => 'برجاء ادخال الوصف الكامل',
            'price.required'=>'برجاء ادخال  السعر  ',
            'active.required'=>'برجاء ادخال نشط او غير نشط',
            'instructor_id.required'=>'برجاء ادخال كورس',
            'categories_id.required'=>'برجاء ادخال كاتيجري الخاص بة',
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
                Image::make($image)->resize(300,300)->Save('upload/backend/Courses/'.$name_gen);
                $save_url = $name_gen;
                // end image

                // start delete old image
                if(file_exists($old_image))
                {
                    unlink(Courses::IMAGE_PATH.$old_image);
                }
                // end delete old image

                // start update
                Courses::find($id)->update([
                    'image'=>$save_url,
                    'name' =>$request->name,
                    'lectures' =>$request->lectures,
                    'duration' =>$request->duration,
                    'level' => $request->level,
                    'language' =>$request->language,
                    'assessments' => $request->assessments,
                    'description' =>$request->description,
                    'certification' => $request->certification,
                    'price' => $request->price,
                    'fullDescription' =>$request->fullDescription,
                    'active'=>$request->active,
                    'instructor_id'=>$request->instructor_id,
                    'categories_id'=>$request->categories_id,
                ]);
                }else{
                    Courses::find($id)->update([
                        'image'=>$old_image,
                        'name' =>$request->name,
                        'lectures' =>$request->lectures,
                        'duration' =>$request->duration,
                        'level' => $request->level,
                        'language' =>$request->language,
                        'assessments' => $request->assessments,
                        'description' =>$request->description,
                        'certification' => $request->certification,
                        'price' => $request->price,
                        'fullDescription' =>$request->fullDescription,
                        'active'=>$request->active,
                        'instructor_id'=>$request->instructor_id,
                        'categories_id'=>$request->categories_id,
                    ]);
                // end update

            }

            session()->flash('Add', 'تم  تعديل  الكورس بنجاح ');
            return redirect('admin/Courses');
    }

    public function destroy(Request $request)
    {
        try {
            $delete = Courses::find($request->invoice_id);
            $old_image = $delete->image;
            $a = ($old_image);
            if($old_image)
            {

                if(file_exists($old_image))
                {
                    unlink(Courses::IMAGE_PATH.$old_image);
                }

              $delete->delete();
            }
                session()->flash('Deleted', 'تم حذف كورس بنجاح');
            return redirect()->back();

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

}
