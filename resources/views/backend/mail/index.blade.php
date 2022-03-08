@extends('layouts.backend.mastar')

@section('title')
    mail
@endsection

@section('css')

@endsection

@section('content')


    <div class="container">
        <div class="jumbotron">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="row">
                <div class="col">
                    @include('backend.massage')
                    <div class="card">
                        <div class="card-header">
                            Send Custom Mail
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{route('sendMail')}}">
                                @csrf

                                <div class="form-group">
                                    <label>Subject</label>
                                    <input required name="subject" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Select users to send mail to</label>
                                    <select required name="users[]" multiple class="form-control">
                                        @foreach ($users as $user)
                                            <option value="{{$user->email}}">{{$user->name}} - {{$user->email}}</option>
                                        @endforeach

                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Message</label>
                                    <textarea required name="body" class="form-control" rows="3"></textarea>
                                </div>
                                <button type="submit" name="button" value="send" class="btn btn-primary">Send Mail</button>

                                <button type="submit" name="button" value="save" class="btn btn-primary">save Mail</button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>


@endsection



@section('js')

@endsection
