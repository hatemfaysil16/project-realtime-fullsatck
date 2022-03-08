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
                            <a href="{{route('Media_center.create')}}" class="btn  btn-outline-primary">اضافه المركز الاعلامي </a>
                        </div>
                    </div>
                    @include('backend.massage')

                    <div class="table-responsive">
                        <table id="datatable" class="table table-striped table-bordered p-0 text-center table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <td> العنوان </td>
                                <td> وصف </td>
                                <td> المحتوي </td>
                                <td> youtube</td>
                                <td> video</td>
                                <td> in_home</td>
                                <td> active</td>
                                <td> صورة</td>
                                <th>العمليات</th>
                            </tr>
                            </thead>

                            @php
                            $i = 1;
                            @endphp
                            <tbody>
                                @foreach($Media_center as $Media)
                                   <tr>
                                       <td>{{$i++}}</td>
                                       <td>{{$Media->title}}</td>
                                       <td>{!! $Media->description !!}</td>
                                       <td>{!! $Media->body !!}</td>
                                       {{-- <td>
                                        {{!(empty($Media->youtube))?'youtube':'no youtube'}}
                                        </td> --}}


                                        @if(!empty($Media->youtube))
                                        <td>
                                         <a  data-fslightbox="gallery" href="{{ asset($Media->youtube)}}"><img src="{{ asset($Media->youtube)? asset('upload/backend/defalte/StartYouTube.jpg'):'' }}" style="width: 70px;height:40px"></a>
                                        </td>
                                        @else
                                        <td>
                                         <img src="{{ asset($Media->youtube)? asset('upload/backend/defalte/NoVideoAvailable.jpg'):'' }}" style="width: 70px;height:40px">
                                        </td>

                                        @endif




                                       @if(!empty($Media->video))
                                       <td>
                                        <a  data-fslightbox="gallery" href="{{ asset('upload/backend/video/'.$Media->video)}}"><img src="{{ asset($Media->video)? asset('upload/backend/defalte/startVideo.png'):'' }}" style="width: 70px;height:40px"></a>
                                       </td>
                                       @else
                                       <td>
                                        <img src="{{ asset($Media->video)? asset('upload/backend/defalte/NoVideoAvailable.jpg'):'' }}" style="width: 70px;height:40px">
                                       </td>

                                       @endif



                                       <td>{{$Media->in_home?'true':'false'}}</td>
                                       <td>{{$Media->active?'true':'false'}}</td>
                                        <td>

                                            <img src="{{ (!empty($Media->image))? url(('upload/backend/Media_center/'.$Media->image)):url('upload/backend/defalte/noImage.jpg') }}" style="width: 70px;height:40px">
                                        </td>




                                    <td>
                                        <button class="btn btn-danger btn-sm" data-invoice_id="{{$Media->id}}"
                                                data-toggle="modal" data-target="#deletedinvoice"><i
                                                class="fa fa-trash"></i></button>

                                        <a href="{{route('Media_center.edit',$Media->id) }}" class="btn btn-info btn-sm" title="تعديل" ><i class="fa fa-edit"></i></a>

                                    </td>


                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
         @include('backend.pages.Media_center.deleted')
    </div>
    <!-- row closed -->
@endsection

@section('js')

<script src="{{ asset('backend/assets/js/fslightbox.js') }}"></script>


<script>
    $('#deletedinvoice').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var invoice_id = button.data('invoice_id')
        var modal = $(this)
        modal.find('.modal-body #invoice_id').val(invoice_id);
    })
</script>
@endsection
