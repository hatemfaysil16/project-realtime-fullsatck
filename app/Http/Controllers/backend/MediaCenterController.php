<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Libs\Upload;
use App\Models\Categories;
use App\Models\Media_center;
use App\Models\Instructors;
use Illuminate\Http\Request;
use Image;

class MediaCenterController extends Controller
{



    public function index()
    {
        $Media_center = Media_center::all();
        return view('backend.pages.Media_center.index',compact('Media_center'));
    }

    public function create()
    {
        $Instructors = Instructors::all();
        $Categories = Categories::all();
        return view('backend.pages.Media_center.create',compact('Instructors','Categories'));
    }

    public function store(Request $request)
    {
        // start validation
        $request->validate([
            'title'=>'required|not_regex:<script>',
            'description' => 'required|not_regex:<script>',
            'body' => 'required|not_regex:<script>',
            // 'image' => 'mimes:jpeg,png,jpg',
            // 'youtube' => 'not_regex:<script>',
            // 'video' => 'not_regex:<script>',
            'in_home' => 'required|not_regex:<script>|boolean',
            'active' => 'required|not_regex:<script>',

            ],[
            'title.required' =>'برجاء ادخال العنوان ',
            'description.required' =>'برجاء ادخال وصف ',
            'body.required' =>'برجاء ادخال المحتوي ',
            // 'image.required' =>'برجاء ادخال الصورة ',
            // 'youtube' =>'برجاء ادخال youtube ',
            // 'video.required' =>'برجاء ادخال video ',
            'in_home.required' =>'برجاء ادخال in_home ',
            'active.required' =>'برجاء ادخال active ',
        ]);
        // end validation


        // return file('image');die;
        if($request->file('image') or $request->file('video') )
        {
            // start image
            if ($request->file('image')) {
                $image = $request->file('image');
                $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
                Image::make($image)->resize(300, 300)->Save('upload/backend/Media_center/'.$name_gen);
                $save_url = $name_gen;
            }
            // end image

            // start video
            if($request->file('video')){
                $file = $request->file('video');
                $filename = $file->getClientOriginalName();
                $path = public_path().'/upload/backend/video';
                $file->move($path, $filename);
                $new_name_video=$filename;
            }
            // end video

            // start create
                Media_center::create([
                    'title' =>$request->title,
                    'description' =>$request->description,
                    'body' =>$request->body,
                    'youtube' => $request->youtube,

                    'image' => ($request->file('image')?$save_url:''),
                    'video' => ($request->file('video')?$new_name_video:''),

                    'in_home' => $request->in_home,
                    'active' => $request->active,
                ]);

        }else{
            Media_center::create([
                'title' =>$request->title,
                'youtube' => $request->youtube,
                'description' =>$request->description,
                'body' =>$request->body,
                'in_home' => $request->in_home,
                'active' => $request->active,
            ]);
        }






        // end create
        session()->flash('Add', 'تم اضافة المركز الاعلامي بنجاح ');
        return redirect('admin/Media_center');
    }

    public function edit($id)
    {
        $Media_center = Media_center::findorFail($id);
        $Instructors = Instructors::all();
        $Categories = Categories::all();
        return view('backend.pages.Media_center.edit',compact('Media_center','Instructors','Categories'));
    }

    public function update(Request $request)
    {
        $id = $request->id;


        // return $request;die;
        // start validation
        $request->validate([
            'title'=>'required|not_regex:<script>',
            'description' => 'required|not_regex:<script>',
            'body' => 'required|not_regex:<script>',
            // 'image' => 'mimes:jpeg,png,jpg',
            // 'youtube' => 'not_regex:<script>',
            // 'video' => 'not_regex:<script>',
            'in_home' => 'required|not_regex:<script>|boolean',
            'active' => 'required|not_regex:<script>',

            ],[
            'title.required' =>'برجاء ادخال العنوان ',
            'description.required' =>'برجاء ادخال وصف ',
            'body.required' =>'برجاء ادخال المحتوي ',
            // 'image.required' =>'برجاء ادخال الصورة ',
            // 'youtube' =>'برجاء ادخال youtube ',
            // 'video.required' =>'برجاء ادخال video ',
            'in_home.required' =>'برجاء ادخال in_home ',
            'active.required' =>'برجاء ادخال active ',
        ]);
        // end validation


        // return $request;die;

        if($request->file('image') or $request->file('video') )
        {

            $old_image = $request->old_image;
            $old_video = $request->old_video;
            // start image
            if ($request->file('image')) {
                $image = $request->file('image');
                $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
                Image::make($image)->resize(300, 300)->Save('upload/backend/Media_center/'.$name_gen);
                $save_url = $name_gen;
                if($old_image)
                {
                    unlink(Media_center::IMAGE_PATH.$old_image);
                }

            }
            // end image

            // start video
            if($request->file('video')){
                $file = $request->file('video');
                $filename = $file->getClientOriginalName();
                $path = public_path().'/upload/backend/video';
                $file->move($path, $filename);
                $new_name_video=$filename;
                if($old_video)
                {
                    if(file_exists($old_video))
                    {
                        unlink(Media_center::IMAGE_PATH_VIDEO.$old_video);
                    }
                }
            }
            // end video











            // start update
                Media_center::find($id)->update([
                    'title' =>$request->title,
                    'description' =>$request->description,
                    'body' =>$request->body,
                    'youtube' => $request->youtube,

                    'image' => ($request->file('image')?$save_url:$old_image),
                    'video' => ($request->file('video')?$new_name_video:$old_video),

                    'in_home' => $request->in_home,
                    'active' => $request->active,
                ]);
            // start update


        }else{
            Media_center::find($id)->update([
                'title' =>$request->title,
                'youtube' => $request->youtube,
                'description' =>$request->description,
                'body' =>$request->body,
                'in_home' => $request->in_home,
                'active' => $request->active,
            ]);
        }





            session()->flash('Add', 'تم  تعديل  المركز الاعلامي بنجاح ');
            return redirect('admin/Media_center');
    }

    public function destroy(Request $request)
    {
        try {
            $delete = Media_center::find($request->invoice_id);

            // return $delete;die;
            $old_image = $delete->image;
            $old_video = $delete->video;



            if($old_image or $old_video)
            {

                if($old_image)
                {
                    unlink(Media_center::IMAGE_PATH.$old_image);
                }

                if($old_video)
                {
                    unlink(Media_center::IMAGE_PATH_VIDEO.$old_video);
                }
              $delete->delete();

            }else{
              $delete->delete();
            }
                session()->flash('Deleted', 'تم حذف المركز الاعلامي بنجاح');
            return redirect()->back();

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

}
