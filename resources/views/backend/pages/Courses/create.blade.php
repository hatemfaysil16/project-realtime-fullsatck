@extends('layouts.backend.mastar')

@section('title')
كورسات
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('backend/assets/css/bootstrap-tagsinput.css') }}">

@endsection

@section('content')

    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0"> اضافة كورسات </h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                    <li class="breadcrumb-item"><a href="{{route('admin_dashboard')}}" class="default-color">الرئيسية</a></li>
                    <li class="breadcrumb-item active">كورسات</li>
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
                    <form action="{{route('Courses.store')}}" method="post" autocomplete="off" enctype="multipart/form-data">
                        @csrf

                        <div class="row">

                            <div class="col-3">
                                <label> الاسم  </label>
                                <input type="text" name="name" value="{{old('name')}}"
                                       class="form-control @error('name') is-invalid @enderror" required>
                            </div>

                            <div class="col-3">
                                <label> كم عدد المحاضرات</label>
                                <input type="number" name="lectures" value="{{old('lectures')}}"
                                       class="form-control @error('lectures') is-invalid @enderror" required>
                            </div>

                            <div class="col-2">
                                <label> المدة الزمنية</label>
                                <input type="number" name="duration" value="{{old('duration')}}"
                                       class="form-control @error('duration') is-invalid @enderror" required>
                            </div>

                            <div class="col-2">
                                <label> مستوى </label>
                                <input type="number" name="level" value="{{old('level')}}"
                                       class="form-control @error('level') is-invalid @enderror" required>
                            </div>


                            <div class="col-2">
                                <label> السعر </label>
                                <input type="number" name="price" value="{{old('price')}}"
                                       class="form-control @error('price') is-invalid @enderror" required>
                            </div>

                        </div>


<br><br>



                    <div class="row">

                        <select name="assessments" value=""
                            class="custom-select col-4">
                                <option disabled="" selected="">اختار الاختبارات</option>
                                <option value="1" @if (old('assessments') == "1") {{ 'selected' }} @endif>true</option>
                                <option value="0" @if (old('assessments') == "0") {{ 'selected' }} @endif>false</option>
                        </select>


                        <select name="active" value=""
                            class="custom-select col-4">
                                <option disabled="" selected="">active or not active</option>
                                <option value="1" @if (old('active') == "1") {{ 'selected' }} @endif>true</option>
                                <option value="0" @if (old('active') == "0") {{ 'selected' }} @endif>false</option>
                        </select>


                        <select name="instructor_id" value=""
                            class="custom-select col-4">
                                <option disabled="" selected="">اختار المدرب</option>
                                @foreach ($Instructors as $Instructor)
                            <option value={{ $Instructor->id }} @if (old('instructor_id') == $Instructor->id) {{ 'selected' }} @endif>{{ $Instructor->name }}</option>
                            @endforeach
                        </select>

                        <br>
                        <br>

                        <select name="categories_id" value=""
                        class="custom-select col-6">
                        <option disabled="" selected="">اختار الفئة</option>
                        @foreach ($Categories as $Categorie)
                        <option value={{ $Categorie->id }} @if (old('categories_id') == $Categorie->id) {{ 'selected' }} @endif>{{ $Categorie->name }}</option>
                        @endforeach
                        </select>

                        <br><br>

                        <select name="language" value="{{old('language')}}"
                        class="custom-select col-6">
                        <option disabled="" selected="">اختار اللغة</option>
                        <option value="en" @if (old('language') == "en") {{ 'selected' }} @endif>en</option>
                        <option value="ar" @if (old('language') == "ar") {{ 'selected' }} @endif>ar</option>
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
                            <label>شهادة</label>
                            <div class="card card-statistics h-100">
                            <div class="card-body">
                            <textarea rows="5" id="certification"name="certification">{{old('certification')}}</textarea>
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
                                <input class="form-control"  type="file"  name="image"/>
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
