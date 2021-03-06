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
                    <form action="{{route('Media_center.store')}}" method="post" autocomplete="off" enctype="multipart/form-data">
                        @csrf

                        <div class="row">

                            <div class="col-3">
                                <label>العنوان  </label>
                                <input type="text" name="title" value="{{old('title')}}"
                                       class="form-control @error('title') is-invalid @enderror" required>
                            </div>



                        </div>


<br><br>



                    <div class="row">

                        <select name="in_home" value=""
                            class="custom-select col-4">
                                <option disabled="" selected="">in_home</option>
                                <option value="1" @if (old('in_home') == "1") {{ 'selected' }} @endif>true</option>
                                <option value="0" @if (old('in_home') == "0") {{ 'selected' }} @endif>false</option>
                        </select>


                        <select name="active" value=""
                            class="custom-select col-4">
                                <option disabled="" selected="">active or not active</option>
                                <option value="1" @if (old('active') == "1") {{ 'selected' }} @endif>true</option>
                                <option value="0" @if (old('active') == "0") {{ 'selected' }} @endif>false</option>
                        </select>



                    </div>



                        <div class="row">
                            <div class="col-5">
                                <label>وصف</label>
                                <div class="card card-statistics h-100">
                                <div class="card-body">
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="26" name="description">{{old('description')}}</textarea>

                                {{-- <textarea rows="5" id="description"name="description">{{old('description')}}</textarea> --}}
                                </div>
                            </div>
                            </div>


                        <div class="col-5">
                            <label>المحتوي</label>
                            <div class="card card-statistics h-100">
                            <div class="card-body">
                            <textarea rows="5" id="body"name="body">{{old('body')}}</textarea>
                            </div>
                        </div>
                        </div>
                    </div>








                        <div class="row">

                            <div class="col-3">
                                <label>youtube  </label>
                                <input type="text" name="youtube" value="{{old('youtube')}}"
                                       class="form-control @error('youtube') is-invalid @enderror">
                            </div>


                            <div class="col-5">
                                <label>الصورة</label>
                                <input class="form-control"  type="file"  name="image"/>
                            </div>





                            <div class="col-5">
                                <label>video</label>
                                <input class="form-control" type="file" name="video"/>
                            </div>

                        </div>





                        <br>

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
<script src="{{ asset('backend/assets/js/bootstrap-tagsinput.js') }}"></script>

@endsection
