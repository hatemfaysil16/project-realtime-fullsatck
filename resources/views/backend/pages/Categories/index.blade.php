@extends('layouts.backend.mastar')

@section('title')
    blank
@endsection

@section('css')

@endsection

@section('content')
    <!--start index -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">

                    <div class="row">
                        <div class="col mb-3">
                            <button type="button" class="btn  btn-outline-primary" data-bs-toggle="modal"
                            data-bs-target="#AddStudentModal">اضافه الفئة </button>
                        </div>
                    </div>
                    @include('backend.massage')

                    <div class="table-responsive">
                        <table id="datatable" class="table table-striped table-bordered p-0 text-center table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>الاسم</th>
                                <th>الصورة</th>
                                <th>العمليات</th>
                            </tr>
                            </thead>

                            @php
                            $i = 1;
                            @endphp

                            <tbody>
                                @foreach($Categories as $Categorie)
                                   <tr>
                                       <td>{{$i++}}</td>
                                       <td>{{$Categorie->name}}</td>
                                        <td>
                                            <img src="{{asset('/upload/backend/Categories/'.$Categorie->image)}}" style="width: 70px;height:40px">
                                        </td>




                                    <td>
                                        <button class="btn btn-danger btn-sm" data-invoice_id="{{$Categorie->id}}"
                                                data-toggle="modal" data-target="#deletedinvoice"><i
                                                class="fa fa-trash"></i></button>

                                        <a href="{{route('Categories.edit',$Categorie->id) }}" class="btn btn-info btn-sm" title="تعديل" ><i class="fa fa-edit"></i></a>

                                    </td>


                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
         @include('backend.pages.Categories.deleted')
    </div>
    <!-- end closed -->


    {{-- start Add create --}}
    @include('backend.pages.Categories.create')
    {{-- end Add create --}}


@endsection

@section('js')

<script src="{{ asset('backend/assets/js/crud/crud.js') }}"></script>
<script>
    $('#deletedinvoice').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var invoice_id = button.data('invoice_id')
        var modal = $(this)
        modal.find('.modal-body #invoice_id').val(invoice_id);
    })
</script>
@endsection
