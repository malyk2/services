@extends('layouts.app')
@include('modules.treetable')
@section('content')
@push('js')
<script>
    $(function(){
        $('.delete-item').on('click', function(e){
            e.preventDefault();
            new PNotify({
                title: 'Підтвердження',
                text: 'Ця дія видалить всі підгрупи та користувачів з групи і підгруп.<br>Ви впевнені?',
                icon: 'glyphicon glyphicon-question-sign',
                hide: true,
                confirm: {
                    confirm: true
                },
                buttons: {
                    closer: false,
                    sticker: false
                },
                history: {
                    history: false
                },
                addclass: 'stack-modal',
                stack: {'dir1': 'down', 'dir2': 'right', 'modal': true}
                }).get().on('pnotify.confirm', function(){
                    window.location.href = $(e.currentTarget).attr('href');
                }).on('pnotify.cancel', function(){

                });
        });
        $("#treetable").treetable({
            expandable: true,
        }).treetable("expandNode", 1);
    });
</script>
@endpush
<div class="right_col" role="main">
    <div class="">
        <div class="clearfix"></div>
        {{ Breadcrumbs::render('user.listGroups') }}
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Групи користувачів</h2>
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
                    <a href="{{ route('user.addGroup') }}" class="btn btn-round btn-primary" aria-label="Left Align">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    <div class="x_content">
                        <table id="treetable" class="table table-bordered treetable">
                            <thead>
                                <tr>
                                    <th>Назва</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $traverse = function ($groups) use (&$traverse) {
                                        foreach ($groups as $group) {
                                            echo '<tr data-tt-id="'.$group->id.'"'.(! empty($group->parent_id) ? 'data-tt-parent-id="'.$group->parent_id.'"':'').'>';
                                            echo '<td>';
                                                echo $group->name;
                                                echo '<span class="label pull-right '.($group->active ? 'label-success' : 'label-danger').'">';
                                                    echo '<i class="fa '.($group->active ? 'fa-unlock' : 'fa-lock' ).'"></i>';
                                                echo '<span>';
                                            echo '</td>';
                                            echo '<td class="text-center">';
                                                if($group->canEdit() || $group->canDelete()){
                                                echo '<div class="btn-group">
                                                    <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle btn-sm" type="button" aria-expanded="false"> <span class="caret"></span>
                                                        </button>
                                                    <ul role="menu" class="dropdown-menu">';
                                                        if($group->canEdit()) {
                                                            echo '<li><a href="'.route('user.editGroup', [$group->id]).'">Редагувати</button></li>';
                                                        }
                                                        if($group->canDelete()) {
                                                            echo '<li><a class="delete-item" href="'.route('user.deleteGroup', [$group->id]).'">Видалити</button></li>';
                                                        }
                                                    echo '</ul>
                                                    </div>';
                                                }
                                            echo '</td>';
                                            echo '</tr>';
                                            $traverse($group->children);
                                        }
                                    };
                                    $traverse($tree);
                                @endphp
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection