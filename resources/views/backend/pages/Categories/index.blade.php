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


                    @include('backend.massage')
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                        اضافة الفئة
                      </button>


                    <div class="table-responsive">
                        <table id="datatable" class="table table-striped table-bordered p-0 text-center table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>الاسم</th>
                                <th>الصورة</th>
                                <th>edit</th>
                                <th>delete</th>
                            </tr>
                            </thead>

                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end closed -->


    {{-- start Add create --}}
    @include('backend.pages.Categories.crud')



    {{-- end Add create --}}


@endsection

@section('js')

<script src="{{ asset('backend/assets/js/crud/crud.js') }}"></script>
<script>


    {{-- $('#deletedinvoice').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var invoice_id = button.data('invoice_id')
        var modal = $(this)
        modal.find('.modal-body #invoice_id').val(invoice_id);
    }) --}}
</script>
@endsection
