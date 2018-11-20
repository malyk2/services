@extends('admin.layouts.app')
@section('content')
<div class="right_col" role="main">
    <div class="">
        <div class="clearfix"></div>
        {{-- {{ Breadcrumbs::render('user.listUsers') }} --}}
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>My services</h2>
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
                        <div class="col-md-1">
                            <a href="{{ route('admin.service.add') }}" class="btn btn-round btn-primary" aria-label="Left Align">
                                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                            </a>
                            </div>
                    </div>
                    <div class="x_content">
                        @if(count($items))
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Type</th>
                                    <th>Duration</th>
                                    <th>Price</th>
                                    <th>Range</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($items as $item)
                                    <tr>
                                        <td>
                                            {{ $item->type->name }}
                                        </td>
                                        <td>
                                            {{ $item->duration_hours }}
                                        </td>
                                        <td>
                                            {{ $item->price }}
                                        </td>
                                        <td>
                                            {{ $item->from->format('d.m.Y').' - '.$item->to->format('d.m.Y') }}
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-group">
                                                <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle btn-sm" type="button" aria-expanded="false">
                                                    <span class="caret"></span>
                                                </button>
                                                <ul role="menu" class="dropdown-menu">
                                                    <li>
                                                        <a href="{{ route('admin.service.edit', [$item->id]) }}">Edit</a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('admin.service.delete', [$item->id]) }}">Delete</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12 text-center paginator">
                                {{ $items->links() }}
                            </div>
                        </div>
                        @else
                            <p>No items</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection