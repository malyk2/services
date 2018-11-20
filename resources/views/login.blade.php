@extends('layouts.basic')
@section('content')
<div class="login_wrapper">
    <div class="animate form login_form">
        <section class="login_content">
            <form action="{{ route('login') }}" method="post">
                @csrf
                <h1>Авторизація</h1>
                <div class="form-group">
                    <input type="text" class="form-control {{ $errors->has('name') ? 'parsley-error' : '' }}" name="name" placeholder="Логін" value="{{ ! is_null(old('name')) ? old('name') : '' }}" />
                    {!! formErrors('name') !!}
                </div>
                <div>
                    <input type="password" class="form-control {{ $errors->has('password') ? 'parsley-error' : '' }}" name="password"  placeholder="Пароль" />
                    {!! formErrors('password') !!}
                </div>
                <div>
                    {{-- <a class="btn btn-default submit" href="index.html">Log in</a> --}}
                    <button class="btn btn-default submit" type="submit">Вхід</button>
                    {{-- <a class="reset_pass" href="#">Lost your password?</a> --}}
                </div>

                <div class="clearfix"></div>

                <div class="separator">
                    <div>
                        <h1><i class="fa fa-object-ungroup"></i> Smart services</h1>
                        {{-- <p>©2016 All Rights Reserved. Gentelella Alela! is a Bootstrap 3 template. Privacy and Terms</p> --}}
                    </div>
                </div>
            </form>
        </section>
    </div>
</div>
@endsection