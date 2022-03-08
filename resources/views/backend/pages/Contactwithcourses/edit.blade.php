@extends('layouts.backend.mastar')

@section('title')
    blank
@endsection

@section('css')

@endsection

@section('content')

    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0"> اضافة حجز الكورس </h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                    <li class="breadcrumb-item"><a href="{{route('admin_dashboard')}}" class="default-color">الرئيسية</a></li>
                    <li class="breadcrumb-item active">حجز الكورس</li>
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
                    <form action="{{route('ContactwithCourses.update','test')}}" method="post" autocomplete="off" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf


                        <div class="row">


                            <input type="hidden" name="id" value="{{$Contacts->id}}">

                            <input type="hidden" value="{{ $Contacts->courses_id }}" name="courses_id">
                            <input type="hidden" value="{{ $Contacts->category_id }}" name="category_id">


                            <div class="col-3">
                                <label>الاسم</label>
                                <input type="text" name="name" value="{{ $Contacts->name }}"
                                       class="form-control @error('name') is-invalid @enderror" required>
                            </div>


                            <div class="col-3">
                                <label>البريد الالكتروني</label>
                                <input type="text" name="email" value="{{ $Contacts->email }}"
                                       class="form-control @error('name') is-invalid @enderror" required>
                            </div>

                            <div class="col-3">
                                <label>موبيل</label>
                                <input type="text" name="mobile" value="{{ $Contacts->mobile }}"
                                       class="form-control @error('name') is-invalid @enderror" required>
                            </div>





                        </div>



                        <div class="row">



                            <div class="row">
                                <div class="col-12">
                                    <label> رسالة </label>
                                    <div class="card card-statistics h-100">
                                    <div class="card-body">
                                    <textarea rows="5" id="exampleFormControlTextarea1"name="message">{{$Contacts->message}}</textarea>
                                    </div>
                                </div>
                                </div>
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
