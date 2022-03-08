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
                <h4 class="mb-0"> اضافة شهادات </h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                    <li class="breadcrumb-item"><a href="{{route('admin_dashboard')}}" class="default-color">الرئيسية</a></li>
                    <li class="breadcrumb-item active">شهادات</li>
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
                    <form action="{{route('Certificates.update','test')}}" method="post" autocomplete="off" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf

                        <div class="row">

                            <input type="hidden" name="id" value="{{ $Certificates->id }}">

                            <div class="col-3">
                                <label> رقم السيريال </label>
                                <input type="text" name="serial" value="{{ $Certificates->serial }}"
                                       class="form-control @error('serial') is-invalid @enderror" required>
                            </div>




                            <div class="col-3">
                                <label>  من تاريح  </label>
                                <input class="form-control" type="date" id="datepicker-action" name="from_date"
                                        data-date-format="yyyy-mm-dd" title="من تاريخ"  value="{{ $Certificates->from_date }}" required>
                                @error('from_date')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>





                            <div class="col-3">
                                <label>  الي تاريح  </label>
                                <input class="form-control" value="{{ $Certificates->to_date }}" type="date" id="datepicker-action" name="to_date"
                                        data-date-format="yyyy-mm-dd" title="الي تاريخ" required>
                                @error('to_date')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>




                            <div class="col-3">
                                <label> الدرجة  </label>
                                <input type="number" name="grade" value="{{ $Certificates->grade }}"
                                       class="form-control @error('grade') is-invalid @enderror" required>
                            </div>


                        </div>



                        <br>





                        <div class="row">

                            <div class="col-12">

                                <select name="courses_id"
                                class="custom-select col-3">
                                   <option disabled="" selected="">اختار الكورس</option>
                                   @foreach ($Courses as $Course)
                                  <option value="{{$Course->id}}"{{ $Course->id == $Certificates->courses_id?'selected':''}}>{{ $Course->name }}</option>
                                  @endforeach
                               </select>

                            </div>

                        </div>




                        <div class="row">




                            <div class="col-5">
                                <label>الصورة</label>
                                <input class="form-control" type="file"  name="image"/>


                                <input type="hidden" name="old_image"  value="{{$Certificates->image}}">
                                <td><img src="{{asset('upload/backend/Certificates/'.$Certificates->image)}}"alt=""></td>


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
