@extends('layouts.app')
@section('content')
<div class="right_col" role="main">
    <div class="">
        <div class="clearfix"></div>
        {{ Breadcrumbs::render('user.listRoles') }}
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Список ролей користувачів</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                <ul class="dropdown-menu" role="menu">
                                </ul>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="row">
                        <form action="" method="get">
                            <div class="col-md-1">
                                <a href="{{ route('user.addRole') }}" class="btn btn-round btn-primary" aria-label="Left Align">
                                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                                </a>
                            </div>
                            <div class="col-md-5 col-md-offset-5">
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="filter_group">
                                        <option value="">Виберіть групу</option>
                                        @foreach($userGroups as $group)
                                            <option value="{{ $group->id }}" {{ $filter_group == $group->id ? 'selected="selected"' : '' }}>{{ $group->full_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="search" class="form-control col-md-7 col-xs-12" placeholder="Пошук" value="{{ $search or '' }}">
                                </div>
                            </div>
                            <div class="col-md-1">
                                <span class="input-group-btn">
                                    <button class="btn btn-success">Шукати</button>
                                </span>
                            </div>
                        </form>
                    </div>
                    <div class="x_content">
                        @if(count($roles))
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Назва</th>
                                    <th>Група</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($roles as $role)
                                    <tr>
                                        <td>
                                            {{ $role->name }}
                                        </td>
                                        <td>
                                            @if($role->group->canEdit())
                                                <a href="{{ route('user.editGroup', [$role->group->id]) }}">
                                                    <i class="fa fa-link">
                                                        {{ $role->group->full_name }}
                                                    </i>
                                                </a>
                                            @else
                                                {{ $role->group->full_name }}
                                            @endif
                                            <span class="label pull-right {{ $role->group->active ? 'label-success' : 'label-danger' }}">
                                                <i class="fa {{ $role->group->active ? 'fa-unlock' : 'fa-lock' }} "></i>
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            @if($role->canEdit() || $role->canDelete())
                                                <div class="btn-group">
                                                    <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle btn-sm" type="button" aria-expanded="false">
                                                        <span class="caret"></span>
                                                    </button>
                                                    <ul role="menu" class="dropdown-menu">
                                                        @if($role->canEdit())
                                                            <li>
                                                                <a href="{{ route('user.editRole', [$role->id]) }}">Редагувати</a>
                                                            </li>
                                                        @endif
                                                        @if($role->canDelete())
                                                            <li>
                                                                <a href="{{ route('user.deleteRole', [$role->id]) }}">Видалити</a>
                                                            </li>
                                                        @endif
                                                    </ul>
                                                </div>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12 text-center paginator">
                                {{ $roles->links() }}
                            </div>
                        </div>
                        @else
                            <p>Дані відсутні</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection