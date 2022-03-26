@extends('layouts.backend.mastar')

@section('title')
المركز الاعلامي
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('backend/assets/css/bootstrap-tagsinput.css') }}">

@endsection

@section('content')

    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0"> اضافة المركز الاعلامي </h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                    <li class="breadcrumb-item"><a href="{{route('admin_dashboard')}}" class="default-color">الرئيسية</a></li>
                    <li class="breadcrumb-item active">المركز الاعلامي</li>
                </ol>
            </div>
        </div>
    </div>

    @include('backend.massage')


    <!-- main body -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <form action="{{route('Media_center.update','test')}}" method="post" autocomplete="off" enctype="multipart/form-data">
                        @method('put')
                        @csrf

                        <input type="hidden" name="id" value="{{$Media_center->id}}">
                        <div class="row">

                            <div class="col-3">
                                <label>العنوان  </label>
                                <input type="text" name="title" value="{{$Media_center->title}}"
                                       class="form-control @error('title') is-invalid @enderror" required>
                            </div>



                        </div>


<br><br>



                    <div class="row">

                        <select name="in_home" value=""
                        class="custom-select col-3">
                           <option disabled="" >in_home</option>
                           @if ($Media_center->in_home==true)
                           <option selected="" value=1>true</option>
                           <option  value=0>false</option>
                           @elseif($Media_center->in_home==0)
                           <option selected="" value=0>false</option>
                           <option  value=1>true</option>
                           @endif
                       </select>


                        <select name="active" value=""
                        class="custom-select col-3">
                           <option disabled="" >active</option>
                           @if ($Media_center->active==true)
                           <option selected="" value=1>true</option>
                           <option  value=0>false</option>
                           @elseif($Media_center->active==0)
                           <option selected="" value=0>false</option>
                           <option  value=1>true</option>
                           @endif
                       </select>



                    </div>



                        <div class="row">
                            <div class="col-5">
                                <label>وصف</label>
                                <div class="card card-statistics h-100">
                                <div class="card-body">
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="26" name="description">{{$Media_center->description}}</textarea>

                                {{-- <textarea rows="5" id="description"name="description">{!! $Media_center->description !!}</textarea> --}}
                                </div>
                            </div>
                            </div>


                        <div class="col-5">
                            <label>المحتوي</label>
                            <div class="card card-statistics h-100">
                            <div class="card-body">
                            <textarea rows="5" id="body"name="body">{!! $Media_center->body !!}</textarea>
                            </div>
                        </div>
                        </div>
                    </div>





                    <div class="row">

                        {{--start edit image --}}
                        <div class="col-3">
                            <label>الصورة</label>
                            <input class="form-control" type="file"  name="image"/>
                            <input type="hidden" name="old_image"  value="{{$Media_center->image}}">

                            <td><img src="{{!empty($Media_center->image)?asset('upload/backend/Media_center/'.$Media_center->image):asset('upload/backend/defalte/noImage.jpg')}}"alt=""  style="width: 100px;height:100px"></td>



                        </div>
                        {{-- end edit image --}}




                    </div>

                        {{--start edit video --}}

                        {{-- <div class="row"> --}}
                            <div class="col-3">
                                <label>video</label>
                                <input class="form-control" type="file" name="video"/>
                            </div>
                            <input type="hidden" name="old_video"  value="{{$Media_center->video}}">

                            <div class="col-2">
                                @if(!empty($Media_center->video))
                                <td>
                                 <a  data-fslightbox="gallery" href="{{ asset('upload/backend/video/'.$Media_center->video)}}"><img src="{{ asset($Media_center->video)? asset('upload/backend/defalte/startVideo.png'):'' }}" style="width: 100px;height:100px"></a>
                                </td>
                                @else
                                <td>
                                 <img src="{{ asset($Media_center->video)? asset('upload/backend/defalte/NoVideoAvailable.jpg'):'' }}" style="width: 100px;height:100px">
                                </td>
                                @endif
                            </div>

                        {{-- </div> --}}
                        {{-- end edit video --}}



                        {{--start edit youtube --}}
                        {{-- <div class="row"> --}}

                            <div class="col-3">
                                <label>youtube  </label>
                                <input type="text" name="youtube" value="{{$Media_center->youtube}}"
                                       class="form-control @error('youtube') is-invalid @enderror">
                            </div>
                            <input type="hidden" name="old_youtube"  value="{{$Media_center->youtube}}">

                            @if(!empty($Media_center->youtube))
                                <td>
                                <a  data-fslightbox="gallery" href="{{ asset($Media_center->youtube)}}"><img src="{{ asset($Media_center->youtube)? asset('upload/backend/defalte/StartYouTube.jpg'):'' }}" style="width: 100px;height:100px"></a>
                                </td>
                            @else
                                <td>
                                <img src="{{ asset($Media_center->youtube)? asset('upload/backend/defalte/NoVideoAvailable.jpg'):'' }}" style="width: 100px;height:100px">
                                </td>
                            @endif


                        {{-- </div> --}}
                        {{-- end edit youtube --}}





                        <div class="row">
                            <div class="col">
                                <button class="btn btn-success">حفظ البيانات</button>
                            </div>
                        </div>


                    </form>
                </div>
            </div>

@endsection



@section('js')
<script src="{{ asset('backend/assets/js/fslightbox.js') }}"></script>
<script src="{{ asset('backend/assets/js/bootstrap-tagsinput.js') }}"></script>
@endsection
