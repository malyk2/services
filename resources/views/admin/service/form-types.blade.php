@extends('admin.layouts.app')
@include('modules.iCheck')
@section('content')
<div class="right_col" role="main">
    <div class="">
        <div class="clearfix"></div>
        {{-- {{ Breadcrumbs::render('user.editAddUser', ! empty($item) ? $item : null) }} --}}
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>{{ empty($item) ? 'Create' : 'Edit' }} service type</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <form class="form-horizontal form-label-left" action="{{ route('admin.service-type.save',[ ! empty($item) ? $item->id : null]) }}" method="post" autocomplete="nope">
                            @csrf
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Name <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="first-name" name="name" class="form-control col-md-7 col-xs-12 {{ $errors->has('name') ? 'parsley-error' : '' }}" value="{{ old('name', ( ! empty($item) ? $item->name : '')) }}">
                                    {!! formErrors('name') !!}
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                    <button type="submit" class="btn btn-success">Save</button>
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