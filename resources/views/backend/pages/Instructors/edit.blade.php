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
                <h4 class="mb-0"> اضافة مدربين </h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                    <li class="breadcrumb-item"><a href="{{route('admin_dashboard')}}" class="default-color">الرئيسية</a></li>
                    <li class="breadcrumb-item active">مدربين</li>
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
                    <form action="{{route('Instructors.update','test')}}" method="post" autocomplete="off" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf


                        <div class="row">


                            <input type="hidden" name="id" value="{{$instructors->id}}">


                            <div class="col-3">
                                <label>الاسم</label>
                                <input type="text" name="name" value="{{ $instructors->name }}"
                                       class="form-control @error('name') is-invalid @enderror" required>
                            </div>

                            <div class="col-3">
                                <label>مسمي الوظيفي</label>
                                <input type="text" name="title" value="{{ $instructors->title }}"
                                       class="form-control @error('title') is-invalid @enderror" required>
                            </div>





                            <div class="col-3">
                                <label> عيد الميلاد </label>
                                <input class="form-control" type="text" id="datepicker-action" name="birthday"
                                        data-date-format="yyyy-mm-dd" value="{{ $instructors->birthday }}" title="عيد الميلاد" required>
                                @error('birthday')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>


                            <div class="col-3">
                                <label>البريد الالكتروني</label>
                                <input type="text" name="email" value="{{ $instructors->email }}"
                                       class="form-control @error('email') is-invalid @enderror" required>
                            </div>


                        </div>




                        <div class="row">
                            <div class="col-5">
                                <label>وصف</label>
                                <div class="card card-statistics h-100">
                                <div class="card-body">
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="26" name="description">{{$instructors->description}}</textarea>

                                {{-- <textarea rows="5" id="description"name="description">{{$instructors->description}}</textarea> --}}
                                </div>
                            </div>
                            </div>


                        <div class="col-5">
                            <label>خبرة</label>
                            <div class="card card-statistics h-100">
                            <div class="card-body">
                            <textarea rows="5" id="experience"name="experience">{{$instructors->experience}}</textarea>
                            </div>
                        </div>
                        </div>
                    </div>


                        <div class="row">

                            <div class="col-5">
                                <label>تخصص</label>
                                <div class="card card-statistics h-100">
                                <div class="card-body">
                                <textarea rows="5" id="specialty"name="specialty">{{$instructors->specialty}}</textarea>
                                </div>
                            </div>
                            </div>

                            <div class="col-5">
                                <label> مرحلة التعليم</label>
                                <div class="card card-statistics h-100">
                                <div class="card-body">
                                <textarea rows="5" id="education"name="education">{{$instructors->education}}</textarea>
                                </div>
                            </div>
                            </div>

                        </div>

                        <br>







                        <div class="row">



                            <div class="col-5">
                                <label> مرحلة التعليم</label>
                                <div class="card card-statistics h-100">
                                <div class="card-body">
                                <textarea rows="5" id="cert_no"name="cert_no">{{$instructors->cert_no}}</textarea>
                                </div>
                            </div>
                            </div>


                        </div>


<br><br><br><br>



                        <div class="row">

                            <div class="col-12">

                                <select name="user_id" list="brow" value=""
                                class="custom-select col-3 selectpicker">
                                   <option selected="" disabled="">اختار المستخدم</option>
                                   @foreach ($users as $user)
                                   <option value="{{$user->id}}"{{ $user->id == $instructors->user_id?'selected':''}}>{{ $user->name }}</option>

                                   @endforeach
                               </select>

                            </div>
                        </div>





                        <div class="row">

                            <div class="col-5">
                                <label>الصورة</label>
                                <input class="form-control" type="file"  name="image"/>


                                <input type="hidden" name="old_image"  value="{{$instructors->image}}">
                                <td><img src="{{asset('upload/backend/instructors/'.$instructors->image)}}"alt=""></td>


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

@endsection
