@extends('layouts.app')
@section('content')
<div class="right_col" role="main">
    <div class="">
        <div class="clearfix"></div>
        {{ Breadcrumbs::render('profile') }}
        <div class="row">
        <div class="col-md-6 col-sm-6 col-xs-6">
            <div class="x_panel">
            <div class="x_title">
                <h2>Основні дані</h2>
                <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                </li>
                <li><a class="close-link"><i class="fa fa-close"></i></a>
                </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <form action="{{ route('profile.save') }}" class="form-horizontal form-label-left input_mask" method="post">
                    @csrf
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Логін
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="first-name" name="name" class="form-control col-md-7 col-xs-12 {{ $errors->has('name') ? 'parsley-error' : '' }}" value="{{  old('name', $user->name) }}">
                            {!! formErrors('name') !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="pib">ПІБ
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="pib" name="pib" class="form-control col-md-7 col-xs-12 {{ $errors->has('pib') ? 'parsley-error' : '' }}" value="{{ old('pib', $user->pib) }}">
                            {!! formErrors('pib') !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Email
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="email" name="email" class="form-control col-md-7 col-xs-12 {{ $errors->has('email') ? 'parsley-error' : '' }}" value="{{ old('email', $user->email)  }}">
                            {!! formErrors('email') !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="position">Посада
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="position" name="position" class="form-control col-md-7 col-xs-12 {{ $errors->has('position') ? 'parsley-error' : '' }}" value="{{ old('position', $user->position) }}">
                            {!! formErrors('position') !!}
                        </div>
                    </div>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                            <button type="submit" class="btn btn-success">Зберегти</button>
                        </div>
                    </div>
                </form>
            </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-6">
            <div class="x_panel">
            <div class="x_title">
                <h2>Зміна паролю</h2>
                <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                </li>
                <li><a class="close-link"><i class="fa fa-close"></i></a>
                </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <form action="{{ route('profile.changePassword') }}" class="form-horizontal form-label-left input_mask" method="post">
                        @csrf
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Старий пароль
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="password" id="first-name" name="old_password" class="form-control col-md-7 col-xs-12 {{ $errors->has('old_password') ? 'parsley-error' : '' }}">
                                {!! formErrors('old_password') !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Новий пароль
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="password" id="first-name" name="password" class="form-control col-md-7 col-xs-12 {{ $errors->has('password') ? 'parsley-error' : '' }}">
                                {!! formErrors('password') !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Підтердження паролю
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="password" id="first-name" name="password_confirmation" class="form-control col-md-7 col-xs-12 {{ $errors->has('password_confirmation') ? 'parsley-error' : '' }}">
                                {!! formErrors('password_confirmation') !!}
                            </div>
                        </div>
                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                <button type="submit" class="btn btn-success">Змінити</button>
                            </div>
                        </div>
                    </form>
            </div>
            </div>
        </div>
        </div>
    </div>
</div>
@endsection
