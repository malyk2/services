@extends('layouts.app')
@include('modules.iCheck')
@section('content')
@push('js')
<script>
    $(function(){
        $('#select-group').on('change', function(e){
            var group = $(this).val();
            var role = $('#role-id').val();
            if(group !== '') {
                var url = '/users/ajax/getPerms/'+group;
                if (role !== '') {
                    url += '/'+role;
                }
                $.ajax({
                    type: 'post',
                    url: url,
                    dataType: 'html',
                    success: function (data) {
                        $('#perms-list').html(data);
                        app.initICheck();
                        NProgress.done();
                    },
                    beforeSend: function() {
                        NProgress.start();
                    },
                });
            } else {
                $('#perms-list').html('');
            }
        });
    });
</script>
@endpush
<div class="right_col" role="main">
    <div class="">
        <div class="clearfix"></div>
        {{ Breadcrumbs::render('user.editAddRole', ! empty($item) ? $item : null) }}
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>{{ empty($item) ? 'Створення' : 'Редагування' }} ролі користувачів</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <form class="form-horizontal form-label-left" action="{{ route('user.saveRole',[ ! empty($item) ? $item->id : null]) }}" method="post" autocomplete="nope">
                            @csrf
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Назва <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="first-name" name="name" class="form-control col-md-7 col-xs-12 {{ $errors->has('name') ? 'parsley-error' : '' }}" value="{{ old('name', ( ! empty($item) ? $item->name : '')) }}">
                                    {!! formErrors('name') !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Група користувачів</label>
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
                            <div id="perms-list">
                                @if( ! empty($item))
                                    @include('user.checkboxesPermissions', ['permissions' => $item->group->permissions, 'item' => $item])
                                @endif
                            </div>
                            <input type="hidden" id="role-id" value="{{ ! empty($item) ? $item->id : null }}">
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