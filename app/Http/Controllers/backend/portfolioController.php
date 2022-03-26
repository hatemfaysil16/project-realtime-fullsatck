<?php

namespace App\Http\Controllers\backend;
use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use App\Repository\portfolioRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Image;
use Carbon\Carbon;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class portfolioController extends Controller
{
    // portfolioRepository
    protected $portfolioRepository;
    public function __construct(portfolioRepository $portfolioRepository)
    {
        $this->portfolioRepository = $portfolioRepository;
    }


    public function MultPic()
    {
        $images = Portfolio::all();
        return view('backend.pages.Portfolio.index',compact('images'));
    }

    public function storeImg(Request $request)
    {

        $brand_image = $request->file('image');

    if($brand_image)
    {


        foreach ($brand_image as $multi_img)
        {
            $name_gen = hexdec(uniqid());
            $img_ext = strtolower($multi_img->getClientOriginalExtension());
            $img_name = $name_gen.'.'.$img_ext;
            $up_location = Portfolio::IMAGE_PATH;
            $last_img = $up_location.$img_name;
            $multi_img->move($up_location,$img_name);

            Portfolio::create([
                'image'=>$last_img,
                'created_at'=>Carbon::now(),
            ]);
        }

    }else{
        Portfolio::create([
            'created_at'=>Carbon::now(),
        ]);  
    }
    return redirect()->back();

}

    public function deleteMulti($id)
    {
        $images = Portfolio::find($id);

        $old_image = $images->image;
        unlink($old_image);

        $images->delete();


        return redirect()->back();

    }



    public function destroy($id)
    {
            $delete = Portfolio::find($id);
            if($delete)
            {
                $old_image = $delete->image;
                if (file_exists(public_path(Portfolio::IMAGE_PATH.$old_image))) {
                    unlink(public_path(Portfolio::IMAGE_PATH.$old_image));
                }
                $delete->delete();
                return response()->json([
                    'status'=>200,
                    'message'=>__("backend/validation.delete"),
                ]);


            }else{
                return response()->json([
                    'status'=>404,
                    'message'=>__("backend/validation.notFound"),
                ]);
            }

    }

}
