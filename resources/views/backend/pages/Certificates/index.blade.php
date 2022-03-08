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
                            <a href="{{route('Certificates.create')}}" class="btn  btn-outline-primary"> اضافة شهادة  </a>
                        </div>
                    </div>
                    @include('backend.massage')

                    <div class="table-responsive">
                        <table id="datatable" class="table table-striped table-bordered p-0 text-center table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th> رقم السيريال </th>
                                <th>نسبة النجاح </th>
                                <th> الكورسات </th>
                                <th> من ناريخ </th>
                                <th> الي تاريخ  </th>
                                <th> الصورة </th>
                                <th>العمليات</th>
                            </tr>
                            </thead>

                            @php
                            $i = 1;
                            @endphp
                            <tbody>


                                @foreach($Certificates as $Certificate)
                                   <tr>
                                       <td>{{$i++}}</td>
                                       <td>{{$Certificate->serial}}</td>
                                       <td>{{$Certificate->grade}}</td>
                                       <td>{{$Certificate->course->name}}</td>
                                       <td>{{$Certificate->from_date}}</td>
                                       <td>{{$Certificate->to_date}}</td>

                                        <td>
                                            <img src="{{asset('upload/backend/Certificates/'.$Certificate->image)}}" style="width: 70px;height:40px">
                                        </td>




                                    <td>
                                        <button class="btn btn-danger btn-sm" data-invoice_id="{{$Certificate->id}}"
                                                data-toggle="modal" data-target="#deletedinvoice"><i
                                                class="fa fa-trash"></i></button>

                                        <a href="{{route('Certificates.edit',$Certificate->id) }}" class="btn btn-info btn-sm" title="تعديل" ><i class="fa fa-edit"></i></a>

                                    </td>


                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
         @include('backend.pages.Certificates.deleted')
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
