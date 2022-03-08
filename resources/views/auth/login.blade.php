
@extends('layouts.frontend.mastar')

@section('title')
    Training
@endsection

@section('css')

@endsection

@section('content')
{{--  start content  --}}

<div class="container mt-5">
    <h1 class="text-center">مرحبا بك في مركز التدريب المهني</h1>
    <div class="row mt-5">
      <div class="col-lg-6 mx-auto">
        <h2 class="text-center">
          تسجيل الدخول
        </h2>
        <p class="fw-bold text-center">بالفعل لدي حساب</p>



        <form method="POST" action="{{ route('login') }}">
            @csrf

            @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

       <!-- Validation Errors -->


        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <!-- Validation Errors -->
        @if($errors->any())

            <ul class="mb-3">
                @foreach ($errors->all() as $error)
                    <li class="text-danger">{{ $error }}</li>
                @endforeach
            </ul>
        @endif




          <div class="form-floating mb-3">
            <input type="email"  class="form-control mg-custom-input" value="{{ old('email') }}" name="email" id="email" placeholder="البريد الإلكتروني" required autofocus>
            <label for="email">البريد الإلكتروني</label>
          </div>


          <div class="input-group form-floating mb-3">
            <button type="button" id="toggle-password"
              class="btn float-label-fix btn-light position-absolute  translate-middle top-50 end-0"><img
                id="toggle-password-icon" data-src="{{asset('frontend/assets/images/eye-slash-solid.svg')}}" data-src-close="{{'frontend/assets/images/eye-solid.svg'}}" src="{{ asset('frontend/assets/images/eye-slash-solid.svg') }}" alt="" width="20"></button>




            <input type="password" name="password" value="{{ old('password') }}" class="form-control mg-custom-input" id="password" placeholder="كلمة المرور">
            <label class="float-label-fix" for="password">كلمة المرور</label>
          </div>




          <div class="mb-3 form-check hstack">
            <input type="checkbox" class="form-check-input" id="remember-me">
            <label  class="form-check-label ms-2 fw-bold" for="remember-me">تذكرني دائما</label>




            <a class="link-secondary ms-auto" href="#">نسيت كلمة المرور</a>
          </div>
          <div class="d-grid col-6 mx-auto gap-2 mt-5">
            <button class="btn pink-button text-white fw-bold d-flex align-items-start" type="submit">
              <img class="" src="{{ asset('frontend/assets/images/envelope-solid.svg') }}" alt="">
              <span class="ms-5 align-self-center">

                تسجيل الدخول
              </span>
            </button>
          </div>
        </form>



      </div>

    </div>
  </div>


{{--  end content --}}
@endsection



@section('js')
<script src="{{ asset('frontend/assets/js/login.js') }}" defer></script>



@endsection



