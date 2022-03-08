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
                            <a href="{{route('Instructors.create')}}" class="btn  btn-outline-primary">اضافه مدريب </a>
                        </div>
                    </div>
                    @include('backend.massage')

                    <div class="table-responsive">
                        <table id="datatable" class="table table-striped table-bordered p-0 text-center table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>الاسم</th>
                                <th>مسمي الوظيفي</th>
                                <th>عيد الميلاد</th>
                                <th>البريد الالكتروني</th>
                                <th>وصف</th>
                                <th>تخصص</th>
                                <th>خبرة</th>
                                <th>مرحلة التعليم</th>
                                <th> شهادة </th>
                                <th>من المستخدم</th>
                                <th> الصورة الشخصيه</th>
                                <th>العمليات</th>
                            </tr>
                            </thead>

                            @php
                            $i = 1;
                            @endphp
                            <tbody>
                                @foreach($instructors as $instructor)
                                   <tr>
                                       <td>{{$i++}}</td>
                                       <td>{{$instructor->name}}</td>
                                       <td>{{$instructor->title}}</td>
                                       <td>{{$instructor->birthday}}</td>
                                       <td>{{$instructor->email}}</td>
                                       <td>{!! $instructor->description !!}</td>
                                       <td>{!! $instructor->specialty !!}</td>
                                       <td>{!! $instructor->experience !!}</td>
                                       <td>{!! $instructor->education !!}</td>
                                       <td>{!! $instructor->cert_no !!}</td>

                                       @if($instructor->user)
                                       <td>{{$instructor->user->name}}</td>
                                       @else
                                       <td> <button type="button" class="btn">NO User</button></td>


                                       @endif

                                        <td>
                                            <img src="{{asset('upload/backend/instructors/'.$instructor->image)}}" style="width: 70px;height:40px">
                                        </td>




                                    <td>
                                        <button class="btn btn-danger btn-sm" data-invoice_id="{{$instructor->id}}"
                                                data-toggle="modal" data-target="#deletedinvoice"><i
                                                class="fa fa-trash"></i></button>

                                        <a href="{{route('Instructors.edit',$instructor->id) }}" class="btn btn-info btn-sm" title="تعديل" ><i class="fa fa-edit"></i></a>

                                    </td>


                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
         @include('backend.pages.Instructors.deleted')
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
