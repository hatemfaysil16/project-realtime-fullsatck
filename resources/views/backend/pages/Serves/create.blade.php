@extends('layouts.backend.mastar')

@section('title')
    blank
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('backend/assets/css/bootstrap-tagsinput.css') }}">

@endsection

@section('content')

    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0"> اضافة خدمات </h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                    <li class="breadcrumb-item"><a href="{{route('admin_dashboard')}}" class="default-color">الرئيسية</a></li>
                    <li class="breadcrumb-item active">خدمات</li>
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
                    <form action="{{route('Serves.store')}}" method="post" autocomplete="off" enctype="multipart/form-data">
                        @csrf

                        <div class="row">

                            <div class="col-6">
                                <label> الاسم  </label>
                                <input type="text" name="name" value="{{old('name')}}"
                                       class="form-control @error('name') is-invalid @enderror" required>
                            </div>





                            <div class="col-6">
                                <label> السعر </label>
                                <input type="number" name="price" value="{{old('price')}}"
                                       class="form-control @error('price') is-invalid @enderror" required>
                            </div>



<br><br>
<br>
<br>










                        </div>




                       <select name="active" value="{{old('active')}}"
                       class="custom-select col-12">
                          <option disabled="" selected="">active or not active</option>
                          <option value="1" @if (old('active') == "1") {{ 'selected' }} @endif>true</option>
                          <option value="0" @if (old('active') == "0") {{ 'selected' }} @endif>false</option>
                      </select>




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

                    </div>


                        <div class="row">

                            <div class="col-5">
                                <label>وصف كامل</label>
                                <div class="card card-statistics h-100">
                                <div class="card-body">
                                <textarea rows="5" id="fullDescription"name="fullDescription">{{old('fullDescription')}}</textarea>
                                </div>
                            </div>
                            </div>
                        </div>





                        <div class="row">

                            <div class="col-5">
                                <label>الصورة</label>
                                <input class="form-control" type="file"  name="image"/>
                                {{-- @error('image')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror --}}
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
