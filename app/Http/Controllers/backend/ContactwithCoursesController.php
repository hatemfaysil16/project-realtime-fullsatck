<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\ContactwithCourse;
use Illuminate\Http\Request;

class ContactwithCoursesController extends Controller
{

    public function index()
    {
        $Contacts = ContactwithCourse::all();
        return view('backend.pages.Contactwithcourses.index',compact('Contacts'));
    }

    public function edit($id)
    {
        $Contacts = ContactwithCourse::findorFail($id);

        return view('backend.pages.Contactwithcourses.edit',compact('Contacts'));
    }

    public function update(Request $request)
    {
        $id = $request->id;
        // start validation
        $validate = $request->validate([
            'name' =>'required|not_regex:<script>|max:50|min:3',
            'email' => 'required|not_regex:<script>',
            'mobile' => 'required|not_regex:<script>|max:50|min:3',
            'message' => 'required|not_regex:<script>',
            'category_id' => 'not_regex:<script>',
            'courses_id' => 'not_regex:<script>',

        ], [
            'name.required' =>'برجاء ادخال الاسم  ',
            'email.required' => 'برجاء ادخال   البريد الالكتروني ',
            'mobile.required' => 'برجاء ادخالي  رقم التلفون',
            'message.required' => 'برجاء ادخالي  الرسالة',
            'message.category_id' => 'برجاء ادخالي  الفئة',
            'message.courses_id' => 'برجاء ادخالي  الكورس',
        ]);
        // end validation


        $old_image = $request->old_image;


        ContactwithCourse::find($id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'message' => $request->message,
            'category_id' => $request->category_id,
            'courses_id' => $request->courses_id,
        ]);

        session()->flash('Add', 'تم اضافة حجز الكورس بنجاح ');
        return redirect('admin/ContactwithCourses');
    }

    public function destroy(Request $request)
    {
        try {

            $delete = ContactwithCourse::find($request->invoice_id);
            if($delete){
                $delete->delete();
            }
            session()->flash('Deleted', 'تم حذف  حجز الكورس بنجاح');
            return redirect()->back();

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

}
