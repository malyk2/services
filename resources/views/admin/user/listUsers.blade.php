@extends('layouts.app')
@section('content')
<div class="right_col" role="main">
    <div class="">
        <div class="clearfix"></div>
        {{ Breadcrumbs::render('user.listUsers') }}
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Список користувачів</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="#">Settings 1</a>
                                    </li>
                                    <li><a href="#">Settings 2</a>
                                    </li>
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
                                <a href="{{ route('user.addUser') }}" class="btn btn-round btn-primary" aria-label="Left Align">
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
                        @if(count($users))
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Логін</th>
                                    <th>ПІБ</th>
                                    <th>E-mail</th>
                                    <th>Група</th>
                                    <th>Ролі</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>
                                            {{ $user->name }}
                                            <span class="label pull-right {{ $user->active ? 'label-success' : 'label-danger' }}">
                                                <i class="fa {{ $user->active ? 'fa-unlock' : 'fa-lock' }} "></i>
                                            </span>
                                        </td>
                                        <td>
                                            {{ $user->pib }}
                                        </td>
                                        <td>
                                            {{ $user->email }}
                                        </td>
                                        <td>
                                            @if($user->group->canEdit())
                                                <a href="{{ route('user.editGroup', [$user->group->id]) }}">
                                                    <i class="fa fa-link">
                                                        {{ $user->group->full_name }}
                                                    </i>
                                                </a>
                                            @else
                                                {{ $user->group->full_name }}
                                            @endif
                                            <span class="label pull-right {{ $user->group->active ? 'label-success' : 'label-danger' }}">
                                                <i class="fa {{ $user->group->active ? 'fa-unlock' : 'fa-lock' }} "></i>
                                            </span>
                                        </td>
                                        <td>
                                            @foreach($user->roles as $role)
                                                {{ $role->name }} {{ ! $loop->last ? ', ' : '' }}
                                            @endforeach
                                        </td>
                                        <td class="text-center">
                                            @if($user->canEdit() || $user->canDelete())
                                                <div class="btn-group">
                                                    <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle btn-sm" type="button" aria-expanded="false">
                                                        <span class="caret"></span>
                                                    </button>
                                                    <ul role="menu" class="dropdown-menu">
                                                        @if($user->canEdit())
                                                            <li>
                                                                <a href="{{ route('user.editUser', [$user->id]) }}">Редагувати</a>
                                                            </li>
                                                        @endif
                                                        @if($user->canDelete())
                                                            <li>
                                                                <a href="{{ route('user.deleteUser', [$user->id]) }}">Видалити</a>
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
                                {{ $users->links() }}
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