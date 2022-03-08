
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
        <div class="col-lg-10 mx-auto">
            <h2 class="text-center">
                إنشاء حساب
            </h2>

            @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

       <!-- Validation Errors -->
        @if($errors->any())
        <br><br>
            <ul class="mb-3">
                @foreach ($errors->all() as $error)
                    <li class="text-danger">{{ $error }}</li>
                @endforeach
            </ul>
        @endif



            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="row my-4">
                    <div class="col-12 col-md-5 me-auto">
                        <div class="form-floating mb-3">
                            <input type="text" name="name" class="form-control mg-custom-input" value="{{ old('name') }}" id="name" placeholder="الاسم" required>
                            <label for="f-name">الاسم</label>
                        </div>
                    </div>






                    <div class="col-12 col-md-5 ms-auto">
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control mg-custom-input" value="{{ old('email') }}" name="email" id="email"
                                placeholder="البريد الإلكتروني" required>
                            <label for="email">البريد الإلكتروني</label>
                        </div>
                    </div>


                </div>








                <div class="row my-4">
                    <div class="col-12 col-md-5 me-auto">
                        <div class="input-group form-floating mb-3">
                            <button type="button" id="toggle-password"
                                class="btn float-label-fix btn-light position-absolute  translate-middle top-50 end-0"><img
                                id="toggle-password-icon" data-src="{{asset('frontend/assets/images/eye-slash-solid.svg')}}" data-src-close="{{'frontend/assets/images/eye-solid.svg'}}" src="{{ asset('frontend/assets/images/eye-slash-solid.svg') }}" alt=""width="20"></button>
                            <input type="password" class="form-control mg-custom-input" id="password" value="{{old('password') }}" name="password"
                                placeholder="كلمة المرور" required autocomplete="new-password">
                            <label class="float-label-fix" for="password">كلمة المرور</label>
                        </div>
                    </div>






                    <div class="col-12 col-md-5 ms-auto">
                        <div class="input-group form-floating mb-3">
                            <button type="button" id="toggle-confirm-password"
                                class="btn float-label-fix btn-light position-absolute  translate-middle top-50 end-0"><img
                                id="toggle-confirm-password-icon" src="{{ asset('frontend/assets/images/eye-slash-solid.svg') }}" alt=""width="20"></button>
                            <input type="password" class="form-control mg-custom-input" id="confirm-password" name="password_confirmation"
                                placeholder="تأكيد كلمة المرور" required>
                            <label class="float-label-fix" for="confirm-password">تأكيد كلمة المرور</label>
                        </div>
                    </div>
                </div>

                <div class="mb-3 form-check hstack">
                    <input type="checkbox" class="form-check-input" id="accept-terms">
                    <label class="form-check-label ms-2 fw-bold" for="accept-terms">أقبل بكل الشروط</label>
                </div>
                <div class="mb-3 form-check hstack">
                    <input type="checkbox" class="form-check-input" id="subscripe">
                    <label class="form-check-label ms-2 fw-bold" for="subscripe">أريد أن يوصلني كل جديد من الشركة عن
                        العروض والأحداث</label>
                </div>
                <div class="d-flex justify-content-center col-6 mx-auto mt-5">
                    <button class="btn pink-button text-white fw-bold px-md-5 " type="submit">
                        إنشاء الحساب
                    </button>
                </div>
            </form>





        </div>

    </div>
</div>
{{--  end content --}}
@endsection



@section('js')

{{--  <script ="js/register.js" defer></script>  --}}
<script src="{{ asset('frontend/assets/js/register.js') }}" defer></script>



@endsection



