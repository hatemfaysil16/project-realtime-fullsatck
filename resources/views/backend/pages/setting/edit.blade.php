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
                <h4 class="mb-0"> تعديل وسائل التواصل الاجتماعي </h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                    <li class="breadcrumb-item"><a href="{{route('admin_dashboard')}}" class="default-color">الرئيسية</a></li>
                    <li class="breadcrumb-item active">وسائل التواصل الاجتماعي</li>
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
                    <form action="{{route('Setting.update','test')}}" method="post" autocomplete="off" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf


                        <div class="row">


                        <input type="hidden" name="id" value="{{$Setting->id}}">

                            <div class="table-responsive">
                                <table id="datatable" class="table table-striped table-bordered p-0 text-center table-hover">
                                    <thead>
                                    <tr>
                                        <th> التواصل الاجتماعي </th>
                                        <th> data </th>
                                    </tr>
                                    </thead>


                                    <tbody>


                                           <tr>
                                               <td>{{$Setting->key}}</td>

                                               <td><input type="text" name="date" value="{{$Setting->value}}"
                                                class="form-control @error('name') is-invalid @enderror" required></td>



                                        </tr>
                                    </tbody>
                                </table>
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
