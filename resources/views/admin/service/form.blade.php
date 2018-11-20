@extends('admin.layouts.app')
@include('modules.iCheck')
@include('modules.inputmask')
@section('content')
@push('js')
<script>
    // $(function(){
    //     $('#duration').inputmask({ alias: "hh:mm"});
    // });
</script>
@endpush
<div class="right_col" role="main">
    <div class="">
        <div class="clearfix"></div>
        {{-- {{ Breadcrumbs::render('user.editAddUser', ! empty($item) ? $item : null) }} --}}
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>{{ empty($item) ? 'Create' : 'Edit' }} service</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <form class="form-horizontal form-label-left" action="{{ route('admin.service.save',[ ! empty($item) ? $item->id : null]) }}" method="post" autocomplete="nope">
                            @csrf
                            {{-- <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Name <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="first-name" name="name" class="form-control col-md-7 col-xs-12 {{ $errors->has('name') ? 'parsley-error' : '' }}" value="{{ old('name', ( ! empty($item) ? $item->name : '')) }}">
                                    {!! formErrors('name') !!}
                                </div>
                            </div> --}}
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Type<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    @if(count($types))
                                        <select class="form-control" name="type_id">
                                            @foreach($types as $type)
                                                <option value="{{ $type->id }}"  {{ ! empty($item) && $item->type_id == $type->id ? 'selected="selected"' : '' }} >{{ $type->name }}</option>
                                            @endforeach
                                        </select>
                                    @else
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Create type first</label>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="price">Price <span class="required">*</span>
                                    </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="price" name="price" class="form-control col-md-7 col-xs-12 {{ $errors->has('price') ? 'parsley-error' : '' }}" value="{{ old('price', ( ! empty($item) ? $item->price : '')) }}" data-inputmask="'alias': 'decimal', 'rightAlign': 'false'">
                                    {!! formErrors('price') !!}
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="duration">Duration <span class="required">*</span>
                                    </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="duration" name="duration" class="form-control col-md-7 col-xs-12 {{ $errors->has('duration') ? 'parsley-error' : '' }}" value="{{ old('duration', ( ! empty($item) ? $item->duration : '')) }}" data-inputmask="'alias': 'hh:mm'">
                                        {!! formErrors('duration') !!}
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