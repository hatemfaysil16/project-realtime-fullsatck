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
                                <th> التواصل الاجتماعي </th>
                                <th> data </th>
                                <th>العمليات</th>
                            </tr>
                            </thead>

                            @php
                            $i = 1;
                            @endphp
                            <tbody>


                                @foreach($Setting as $item)
                                   <tr>
                                       <td>{{$i++}}</td>
                                       <td>{{$item->id}}</td>
                                       <td>{{$item->key}}</td>
                                       <td>{{$item->value}}</td>

                                    <td>
                                        <a href="{{route('Setting.edit',$item->id) }}" class="btn btn-info btn-sm" title="تعديل" ><i class="fa fa-edit"></i></a>
                                    </td>


                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @include('backend.pages.setting.deleted')
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
