@extends('layouts.app')
@include('modules.iCheck')
@section('content')
@push('js')
<script>
    $(function(){
        $('#select-group').on('change', function(e){
            var group = $(this).val();
            if(group !== '') {
                $.ajax({
                    url: '/users/ajax/getRoles/'+group,
                    type: 'post',
                    dataType: 'html',
                    success: function (data) {
                        NProgress.done();
                        $('#roles-list').html(data);
                    },
                    beforeSend: function() {
                        NProgress.start();
                    },
                });
            } else {
                $('#roles-list').html('');
            }
        });
    });
</script>
@endpush
<div class="right_col" role="main">
    <div class="">
        <div class="clearfix"></div>
        {{ Breadcrumbs::render('user.editAddUser', ! empty($item) ? $item : null) }}
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>{{ empty($item) ? 'Створення' : 'Редагування' }} користувача</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <form class="form-horizontal form-label-left" action="{{ route('user.saveUser',[ ! empty($item) ? $item->id : null]) }}" method="post" autocomplete="nope">
                            @csrf
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Логін <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="first-name" name="name" class="form-control col-md-7 col-xs-12 {{ $errors->has('name') ? 'parsley-error' : '' }}" value="{{ old('name', ( ! empty($item) ? $item->name : '')) }}">
                                    {!! formErrors('name') !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="pib">ПІБ <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="pib" name="pib" class="form-control col-md-7 col-xs-12 {{ $errors->has('pib') ? 'parsley-error' : '' }}" autocomplete="nope" value="{{ old('pib', ( ! empty($item) ? $item->pib : '')) }}">
                                    {!! formErrors('pib') !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">E-mail
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="email" name="email" class="form-control col-md-7 col-xs-12 {{ $errors->has('email') ? 'parsley-error' : '' }}" autocomplete="nope" value="{{ old('email', ( ! empty($item) ? $item->email : '')) }}">
                                    {!! formErrors('email') !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="position">Посада
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="position" name="position" class="form-control col-md-7 col-xs-12 {{ $errors->has('position') ? 'parsley-error' : '' }}" autocomplete="nope" value="{{ old('position', ( ! empty($item) ? $item->position : '')) }}">
                                    {!! formErrors('position') !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password">Пароль <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="password" id="password" name="password" class="form-control col-md-7 col-xs-12 {{ $errors->has('password') ? 'parsley-error' : '' }}" autocomplete="new-password">
                                    {!! formErrors('password') !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Група</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select id="select-group" class="form-control {{ $errors->has('group_id') ? 'parsley-error' : '' }}" name="group_id">
                                        <option value="">Виберіть групу</option>
                                        @php
                                            $item = ! empty($item) ? $item : null;
                                            $traverse = function ($groups, $prefix = '') use (&$traverse, $item) {
                                                foreach ($groups as $group) {
                                                    echo '<option value="'.$group->id.'"'.( ! empty($item) && $item->group_id == $group->id ? 'selected' : '').'>'.$prefix.' '.$group->name.'</option>';
                                                    $traverse($group->children, $prefix.'-');
                                                }
                                            };
                                            $traverse($groupsTree);
                                        @endphp
                                    </select>
                                    {!! formErrors('group_id') !!}
                                </div>
                            </div>
                            <div id="roles-list">
                                @if( ! empty($item))
                                    @include('user.selectRoles', ['item' => $item, 'roles' => $item->group->roles])
                                @endif
                            </div>
                            <input type="hidden" name="active" value="0">
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Вхід</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" class="flat" name="active" value="1" {{ (! empty($item) && $item->active) || empty($item) ? 'checked="checked"' : '' }}>
                                        </label>
                                    </div>
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
        </div>
    </div>
</div>
@endsection