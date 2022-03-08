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
                    <form action="{{route('Instructors.store')}}" method="post" autocomplete="off" enctype="multipart/form-data">
                        @csrf

                        <div class="row">


                            <div class="col-3">
                                <label>الاسم</label>
                                <input type="text" name="name" value="{{old('name')}}"
                                       class="form-control @error('name') is-invalid @enderror" required>
                            </div>

                            <div class="col-3">
                                <label>مسمي الوظيفي</label>
                                <input type="text" name="title" value="{{old('title')}}"
                                       class="form-control @error('title') is-invalid @enderror" required>
                            </div>





                            <div class="col-3">
                                <label> عيد الميلاد </label>
                                <input class="form-control" type="text" id="datepicker-action" name="birthday"
                                        data-date-format="yyyy-mm-dd" value="{{old('birthday')}}" title="عيد الميلاد" required>
                                @error('birthday')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>


                            <div class="col-3">
                                <label>البريد الالكتروني</label>
                                <input type="text" name="email" value="{{old('email')}}"
                                       class="form-control @error('email') is-invalid @enderror" required>
                            </div>


                        </div>




                        <div class="row">
                            <div class="col-5">
                                <label>وصف</label>
                                <div class="card card-statistics h-100">
                                <div class="card-body">
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="26" name="description">{{old('description')}}</textarea>

                                {{-- <textarea rows="5" id="description"name="description">{{old('description')}} </textarea> --}}
                                </div>
                            </div>
                            </div>


                        <div class="col-5">
                            <label>خبرة</label>
                            <div class="card card-statistics h-100">
                            <div class="card-body">
                            <textarea rows="5" id="experience"name="experience"> {{old('experience')}}</textarea>
                            </div>
                        </div>
                        </div>
                    </div>


                        <div class="row">

                            <div class="col-5">
                                <label>تخصص</label>
                                <div class="card card-statistics h-100">
                                <div class="card-body">
                                <textarea rows="5" id="specialty"name="specialty">{{old('specialty')}} </textarea>
                                </div>
                            </div>
                            </div>

                            <div class="col-5">
                                <label> مرحلة التعليم</label>
                                <div class="card card-statistics h-100">
                                <div class="card-body">
                                <textarea rows="5" id="education"name="education">{{old('education')}} </textarea>
                                </div>
                            </div>
                            </div>


                        </div>

                        <br>

                        <div class="row">



                            <div class="col-5">
                                <label> مرحلة الشهادة</label>
                                <div class="card card-statistics h-100">
                                <div class="card-body">
                                <textarea rows="5" id="cert_no"name="cert_no">{{old('cert_no')}} </textarea>
                                </div>
                            </div>
                            </div>



                        </div>

sasads
<br>
<br>
<br>
<br>

                        <div class="row">

                            <div class="col-12">

                                <select name="user_id" list="brow" value=""
                                class="custom-select col-3 selectpicker">
                                   <option selected="" disabled="">اختار المستخدم</option>
                                   @foreach ($user as $k)
                                   <option value={{$k->id}} @if (old('user_id') == $k->id) {{ 'selected' }} @endif>{{ $k->name }}</option>
                                   @endforeach
                               </select>

                            </div>
                        </div>


                        <div class="row">

                            <div class="col-5">
                                <label>الصورة</label>
                                <input class="form-control" type="file"  name="image"/>
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
