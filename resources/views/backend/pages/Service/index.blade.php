@extends('layouts.backend.mastar')



@section('title')
slider
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
                        {{__('backend/services.Add_services') }}
                    </button>


                    <div class="table-responsive">
                        <table id="datatable" class="table table-striped table-bordered p-0 text-center table-hover">
                            <thead>
                            <tr>


                                <th>#</th>
                                <th>{{__('backend/public.name') }}</th>
                                <th>describtion </th>
                                <th>{{__('backend/public.active') }}</th>
                                <th>{{__('backend/public.image') }}</th>
                                <th>{{__('backend/public.operations') }}</th>
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
    @include('backend.pages.Service.crud')
    {{-- end Add create --}}


@endsection

@section('js')
<script src="{{ asset('backend/assets/js/fslightbox.js') }}"></script>
<script src="{{ asset('backend/assets/js/crud/Service.js') }}"></script>

<script>



</script>
@endsection
