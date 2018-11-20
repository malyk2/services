@extends('admin.layouts.basic')
@section('content')
<div class="login_wrapper">
    <div class="animate form login_form">
        <section class="login_content">
            <form action="{{ route('admin.login') }}" method="post">
                @csrf
                <h1>Sign in</h1>
                <div class="form-group">
                    <input type="text" class="form-control {{ $errors->has('email') ? 'parsley-error' : '' }}" name="email" placeholder="E-mail" value="{{ ! is_null(old('email')) ? old('email') : '' }}" />
                    {!! formErrors('email') !!}
                </div>
                <div>
                    <input type="password" class="form-control {{ $errors->has('password') ? 'parsley-error' : '' }}" name="password"  placeholder="Password" />
                    {!! formErrors('password') !!}
                </div>
                <div>
                    <button class="btn btn-default submit" type="submit">Login</button>
                </div>

                <div class="clearfix"></div>

                <div class="separator">
                    <div>
                        <h1><i class="fa fa-object-ungroup"></i> Services</h1>
                    </div>
                </div>
            </form>
        </section>
    </div>
</div>
@endsection