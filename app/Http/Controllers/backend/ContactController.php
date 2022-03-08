<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{

    public function index()
    {
        $Contacts = Contact::all();
        return view('backend.pages.Contact.index',compact('Contacts'));
    }

    public function edit($id)
    {
        $Contacts = Contact::findorFail($id);
        return view('backend.pages.Contact.edit',compact('Contacts'));
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
            ], [
            'name.required' =>'برجاء ادخال الاسم  ',
            'email.required' => 'برجاء ادخال   البريد الالكتروني ',
            'mobile.required' => 'برجاء ادخالي  رقم التلفون',
            'message.required' => 'برجاء ادخالي  الرسالة',
            ]);
        // end validation


        $old_image = $request->old_image;


        Contact::find($id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'message' => $request->message,
        ]);

        session()->flash('Add', 'تم اضافة تواصل معنا بنجاح ');
        return redirect('admin/Contact');
    }

    public function destroy(Request $request)
    {
        try {

            $delete = Contact::find($request->invoice_id);
            $delete->delete();
            session()->flash('Deleted', 'تم حذف  تواصل معنا بنجاح');
            return redirect()->back();

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

}
