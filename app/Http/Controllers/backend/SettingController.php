<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Settings;

class SettingController extends Controller
{

    public function index()
    {
       $Setting = Settings::all();
        return view('backend.pages.setting.index',compact('Setting'));
    }

    public function edit($id)
    {
        $Setting = Settings::findorFail($id);
        return view('backend.pages.setting.edit',compact('Setting'));
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $validate = $request->validate([
        'date' =>'required|max:50|min:3',
        ], [
        'date.required' =>'برجاء ادخال الاسم  ',
           ]);
        Settings::find($id)->update([
        'value' => $request->date,
          ]);
        session()->flash('Add', 'تم تعديل وسائل التواصل الاجتماعي ');
        return redirect('admin/Setting');
    }

}
