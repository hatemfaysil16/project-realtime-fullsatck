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
                    <form action="{{route('Courses.update','test')}}" method="post" autocomplete="off" enctype="multipart/form-data">
                        @method('put')
                        @csrf
                        <div class="row">
                            <input type="hidden" name="id" value="{{ $Courses->id }}">
                            <div class="col-3">
                                <label> الاسم  </label>
                                <input type="text" name="name" value="{{$Courses->name}}"
                                       class="form-control @error('name') is-invalid @enderror" required>
                            </div>

                            <div class="col-2">
                                <label> كم عدد المحاضرات</label>
                                <input type="number" name="lectures" value="{{$Courses->lectures}}"
                                       class="form-control @error('lectures') is-invalid @enderror" required>
                            </div>





                            <div class="col-2">
                                <label> المدة الزمنية</label>
                                <input type="number" name="duration" value="{{$Courses->duration}}"
                                       class="form-control @error('duration') is-invalid @enderror" required>
                            </div>





                            <div class="col-2">
                                <label> مستوى </label>
                                <input type="number" name="level" value="{{$Courses->level}}"
                                       class="form-control @error('level') is-invalid @enderror" required>
                            </div>

                            <div class="col-3">
                                <label> السعر </label>
                                <input type="number" name="price" value="{{$Courses->level}}"
                                       class="form-control @error('price') is-invalid @enderror" required>
                            </div>


                            <select name="assessments" value=""
                            class="custom-select col-3">
                               <option disabled="" >اختار الاختبارات</option>
                               @if ($Courses->assessments==true)
                               <option selected="" value=1>true</option>
                               <option  value=0>false</option>
                               @elseif($Courses->assessments==0)
                               <option selected="" value=0>false</option>
                               <option  value=1>true</option>
                               @endif
                           </select>




                          <select name="active" value=""
                          class="custom-select col-3">
                             <option disabled="" >active</option>
                             @if ($Courses->assessments==true)
                             <option selected="" value=1>true</option>
                             <option  value=0>false</option>
                             @elseif($Courses->assessments==0)
                             <option selected="" value=0>false</option>
                             <option  value=1>true</option>
                             @endif
                         </select>




                          <select name="instructor_id" value=""
                          class="custom-select col-3">
                             <option selected="" disabled="">اختار المدرب</option>
                             @foreach ($Instructors as $Instructor)
                            <option value="{{ $Instructor->id}}"{{ $Instructor->id == $Courses->instructor_id?'selected':''}}>{{ $Instructor->name }}</option>
                            @endforeach
                         </select>



                         <select name="categories_id" value=""
                         class="custom-select col-3">
                            <option selected="" disabled="">اختار الفئة</option>
                            @foreach ($Categories as $Categorie)
                           <option value="{{ $Categorie->id }}"{{ $Categorie->id == $Courses->categories_id?'selected':''}}>{{ $Categorie->name }}</option>
                           @endforeach
                        </select>



                        <select name="language" value=""
                        class="custom-select col-3">
                           <option disabled="" >اختار اللغة</option>
                           @if ($Courses->language=='en')
                           <option selected="" value="en">en</option>
                           <option  value="ar">ar</option>
                           @elseif($Courses->language=='ar')
                           <option selected="" value="ar">ar</option>
                           <option  value="en">en</option>
                           @endif
                       </select>



                        </div>




                        <div class="row">
                            <div class="col-5">
                                <label>وصف</label>
                                <div class="card card-statistics h-100">
                                <div class="card-body">

                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="26" name="description">{{$Courses->description}}</textarea>

                                {{-- <textarea rows="5" id="description"name="description"> {{$Courses->description}} </textarea> --}}
                                </div>
                            </div>
                            </div>


                        <div class="col-5">
                            <label>شهادة</label>
                            <div class="card card-statistics h-100">
                            <div class="card-body">
                            <textarea rows="5" id="certification"name="certification"> {{$Courses->certification}} </textarea>

                            {{-- <textarea rows="5" id="certification"name="certification">{{$Courses->certification}}</textarea> --}}
                            </div>
                        </div>
                        </div>
                    </div>


                        <div class="row">

                            <div class="col-5">
                                <label>وصف كامل</label>
                                <div class="card card-statistics h-100">
                                <div class="card-body">
                                <textarea rows="5" id="fullDescription"name="fullDescription"> {{$Courses->fullDescription}} </textarea>
                                </div>
                            </div>
                            </div>
                        </div>








                        <div class="row">

                            <div class="col-5">
                                <label>الصورة</label>
                                <input class="form-control" type="file"  name="image"/>


                                <input type="hidden" name="old_image"  value="{{$Courses->image}}">

                                <td><img src="{{asset('upload/backend/Courses/'.$Courses->image)}}"alt=""></td>


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
