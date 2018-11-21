@extends('admin.layouts.app')
@include('modules.iCheck')
@include('modules.inputmask')
@include('modules.moment')
@include('modules.daterangepicker')
@section('content')
@push('js')
<script>
    var input = $('#range');
    var startDate = input.data('from') == '' ? moment() : input.data('from');
    var endDate = input.data('to') == '' ? moment().endOf('month') : input.data('to');

    var cb = function(start, end, label) {
        $('#reportrange_right span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
    };

    var optionSet1 = {
        startDate: startDate,
        endDate: endDate,
        showDropdowns: true,
        showWeekNumbers: true,
        ranges: {
            'Today': [moment(), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
        },
        opens: 'right',
        locale: {
            format: 'DD.MM.YYYY',
        }
    };

    input.daterangepicker(optionSet1, cb);

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
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Type <span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    @if(count($types))
                                        <select class="form-control" name="type_id">
                                            @foreach($types as $type)
                                                <option value="{{ $type->id }}"  {{ ! empty($item) && old('type_id', $item->type_id) == $type->id ? 'selected="selected"' : (old('type_id') == $type->id ? 'selected' : '') }} >{{ $type->name }}</option>
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
                                    <input type="text" id="duration" name="duration" class="form-control col-md-7 col-xs-12 {{ $errors->has('duration') ? 'parsley-error' : '' }}" value="{{ old('duration', ( ! empty($item) ? secondsToHour($item->duration) : '')) }}" data-inputmask="'alias': 'hh:mm'">
                                    {!! formErrors('duration') !!}
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="range">Range <span class="required">*</span>
                                </label>
                                <fieldset>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="control-group">
                                        <div class="controls">
                                            <div class="input-prepend input-group">
                                                <span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
                                                <input type="text" style="width: 200px" name="range" id="range" class="form-control {{ $errors->has('range') ? 'parsley-error' : '' }}" value="" readonly data-from="{{ ! empty($item) ? $item->from->format('d.m.Y') : '' }}" data-to="{{ ! empty($item) ? $item->to->format('d.m.Y') : '' }}"/>
                                                {!! formErrors('range') !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </fieldset>
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