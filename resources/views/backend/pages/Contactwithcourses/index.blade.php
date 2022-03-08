@extends('layouts.backend.mastar')

@section('title')
    blank
@endsection

@section('css')

@endsection

@section('content')
        <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">


                    @include('backend.massage')

                    <div class="table-responsive">
                        <table id="datatable" class="table table-striped table-bordered p-0 text-center table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>الاسم</th>
                                <th>البريد الالكتروني</th>
                                <th> رقم التلفون </th>
                                <th> رسالة </th>
                                <th> الفئة </th>
                                <th> الكورس </th>
                                <th>العمليات</th>
                            </tr>
                            </thead>

                            @php
                            $i = 1;
                            @endphp

                            <tbody>
                                @foreach($Contacts as $Contact)
                                   <tr>
                                       <td>{{$i++}}</td>
                                       <td>{{$Contact->name}}</td>
                                       <td>{{$Contact->email}}</td>
                                       <td>{{$Contact->mobile}}</td>
                                       <td>{!! $Contact->message !!}</td>
                                       <td>{{$Contact->category->name}}</td>
                                       <td>{{$Contact->courses->name}}</td>




                                       <td>
                                        <button class="btn btn-danger btn-sm" data-invoice_id="{{$Contact->id}}"
                                                data-toggle="modal" data-target="#deletedinvoice"><i
                                                class="fa fa-trash"></i></button>

                                        <a href="{{route('ContactwithCourses.edit',$Contact->id) }}" class="btn btn-info btn-sm" title="تعديل" ><i class="fa fa-edit"></i></a>

                                    </td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
         @include('backend.pages.Contactwithcourses.deleted')
    </div>
    <!-- row closed -->
@endsection

@section('js')
<script>
    $('#deletedinvoice').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var invoice_id = button.data('invoice_id')
        var modal = $(this)
        modal.find('.modal-body #invoice_id').val(invoice_id);
    })
</script>
@endsection
