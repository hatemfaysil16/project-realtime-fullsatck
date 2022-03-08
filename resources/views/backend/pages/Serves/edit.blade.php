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
                    <form action="{{route('Serves.update','test')}}" method="post" autocomplete="off" enctype="multipart/form-data">
                        @method('put')
                        @csrf
                        <div class="row">
                            <input type="hidden" name="id" value="{{ $Serves->id }}">
                            <div class="col-6">
                                <label> الاسم  </label>
                                <input type="text" name="name" value="{{$Serves->name}}"
                                       class="form-control @error('name') is-invalid @enderror" required>
                            </div>


                            <div class="col-6">
                                <label> السعر </label>
                                <input type="number" name="price" value="{{$Serves->price}}"
                                       class="form-control @error('price') is-invalid @enderror" required>
                            </div>


                        </div>

                        <br>
                        <select name="active" value=""
                        class="custom-select col-12">
                           <option disabled="" >active</option>
                           @if ($Serves->active==true)
                           <option selected="" value=1>true</option>
                           <option  value=0>false</option>
                           @elseif($Serves->active==0)
                           <option selected="" value=0>false</option>
                           <option  value=1>true</option>
                           @endif
                       </select>



                        <div class="row">
                            <div class="col-5">
                                <label>وصف</label>
                                <div class="card card-statistics h-100">
                                <div class="card-body">
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="26" name="description">{{$instructors->description}}</textarea>


                                </div>
                            </div>
                            </div>


                    </div>


                        <div class="row">

                            <div class="col-5">
                                <label>وصف كامل</label>
                                <div class="card card-statistics h-100">
                                <div class="card-body">
                                <textarea rows="5" id="fullDescription"name="fullDescription"> {{$Serves->fullDescription}} </textarea>
                                </div>
                            </div>
                            </div>
                        </div>




                        <div class="row">

                            <div class="col-5">
                                <label>الصورة</label>
                                <input class="form-control" type="file"  name="image"/>


                                <input type="hidden" name="old_image"  value="{{$Serves->image}}">

                                <td><img src="{{asset('upload/backend/Serves/'.$Serves->image)}}"alt=""></td>


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
