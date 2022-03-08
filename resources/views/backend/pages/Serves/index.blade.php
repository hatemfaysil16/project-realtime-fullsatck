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

                    <div class="row">
                        <div class="col mb-3">
                            <a href="{{route('Serves.create')}}" class="btn  btn-outline-primary">اضافه خدمات </a>
                        </div>
                    </div>
                    @include('backend.massage')

                    <div class="table-responsive">
                        <table id="datatable" class="table table-striped table-bordered p-0 text-center table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <td> الاسم </td>
                                <td> active </td>
                                <td> السعر </td>
                                <td> وصف </td>
                                <td>  وصف كامل </td>
                                <th>صورة</th>
                                <th>العمليات</th>
                            </tr>
                            </thead>

                            @php
                            $i = 1;
                            @endphp
                            <tbody>
                                @foreach($Serves as $Serve)
                                   <tr>
                                       <td>{{$i++}}</td>
                                       <td>{{$Serve->name}}</td>
                                       <td>{{$Serve->active?'true':'false'}}</td>
                                       <td>{{$Serve->price}}</td>
                                       <td>{!! $Serve->description!!}</td>
                                       <td>{!! $Serve->fullDescription !!}</td>

                                        <td>
                                            <img src="{{asset('upload/backend/Serves/'.$Serve->image)}}" style="width: 70px;height:40px">
                                        </td>




                                    <td>
                                        <button class="btn btn-danger btn-sm" data-invoice_id="{{$Serve->id}}"
                                                data-toggle="modal" data-target="#deletedinvoice"><i
                                                class="fa fa-trash"></i></button>

                                        <a href="{{route('Serves.edit',$Serve->id) }}" class="btn btn-info btn-sm" title="تعديل" ><i class="fa fa-edit"></i></a>

                                    </td>


                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
         @include('backend.pages.Serves.deleted')
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
