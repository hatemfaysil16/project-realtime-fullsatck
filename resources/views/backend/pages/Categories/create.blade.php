    {{-- Add Modal --}}
    <div class="modal fade" id="AddStudentModal" tabindex="-1" aria-labelledby="AddStudentModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="AddStudentModalLabel">اضافه الفئة</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <ul id="save_msgList"></ul>

                    <div class="form-group mb-3">
                        <label for=""> الاسم</label>
                        <input type="text" name="name" value="{{old('name')}}" required class="name form-control">
                    </div>
                    <div class="form-group mb-3">
                        <label for="">الصورة</label>
                        <input  type="file"  name="image" required class="course form-control">
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary add_student">Save</button>
                </div>

            </div>
        </div>
    </div>
















{{-- @extends('layouts.backend.mastar')








@section('title')
    blank
@endsection

@section('css')

@endsection

@section('content')

    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0"> اضافة الفئة </h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                    <li class="breadcrumb-item"><a href="{{route('admin_dashboard')}}" class="default-color">الرئيسية</a></li>
                    <li class="breadcrumb-item active">الفئة</li>
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



                    <form action="{{route('Categories.store')}}" method="post" autocomplete="off" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-3">
                                <label>الاسم</label>
                                <input type="text" name="name" value="{{old('name')}}"
                                       class="form-control @error('name') is-invalid @enderror" required>
                            </div>
                        </div>




                        <div class="row">

                            <div class="col-5">
                                <label>الصورة</label>
                                <input class="form-control" type="file"  name="image"/>

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

@endsection --}}
