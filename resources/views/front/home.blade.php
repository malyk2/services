@extends('front.layouts.app')
    @include('modules.select2')
    @include('modules.moment')
    @include('modules.daterangepicker')
    @include('modules.fullcalendar') @push('js')
<script src="{{ asset('js/booking.js') }}"></script>
<script>
    $(function(){
    // console.log('init_calendar');

    // var date = new Date(),
    //     d = date.getDate(),
    //     m = date.getMonth(),
    //     y = date.getFullYear(),
    //     started,
    //     categoryClass;

    // var calendar = $('#calendar').fullCalendar({
    //     header: {
    //         left: 'prev,next',
    //         center: 'title',
    //         right: 'month,agendaWeek,agendaDay,listMonth'
    //     },
    //     defaultView: 'agendaWeek',
    //     selectable: true,
    //     selectHelper: true,
    //     slotDuration: '00:20',
    //     selectAllow: function(selectInfo) {
    //         var duration = moment.duration(selectInfo.end.diff(selectInfo.start));
    //         console.log('duration');
    //         console.log(duration.asSeconds());
    //         return duration.asSeconds() <= 3600;
    //         return duration.asHours() <= 4;
    //     },
    //     select: function(start, end, allDay) {
    //         // console.log('start');
    //         // console.log(start);
    //         // console.log('end');
    //         // console.log(end);
    //         // console.log('allDay');
    //         // console.log(allDay);
    //         // console.log('SELECT');
    //         // $('#fc_create').click();
    //         started = start;
    //         ended = end;
    //     },
    //     validRange: {
    //         start: moment(),
    //         end: '2018-11-27'
    //     },
    //     eventClick: function(calEvent, jsEvent, view) {
    //         console.log('eventClick');
    //         // $('#fc_edit').click();
    //         // $('#title2').val(calEvent.title);

    //         // categoryClass = $("#event_type").val();

    //         // $(".antosubmit2").on("click", function() {
    //         //     calEvent.title = $("#title2").val();

    //         //     calendar.fullCalendar('updateEvent', calEvent);
    //         //     $('.antoclose2').click();
    //         // });

    //         // calendar.fullCalendar('unselect');
    //     },
    //     eventRender: function(event, element) {
    //         console.log('RENDER');
    //         console.log(event.end);
    //         if (element.find(".fc-helper")){
    //             element.find(".fc-time").text('my-string');
    //         }
    //     },
    //     // editable: true,
    //     // events: [{
    //     //     title: 'All Day Event',
    //     //     start: new Date(y, m, 1)
    //     // }, {
    //     //     title: 'Long Event',
    //     //     start: new Date(y, m, d - 5),
    //     //     end: new Date(y, m, d - 2)
    //     // }, {
    //     //     title: 'Meeting',
    //     //     start: new Date(y, m, d, 10, 30),
    //     //     allDay: false
    //     // }, {
    //     //     title: 'Lunch',
    //     //     start: new Date(y, m, d + 14, 12, 0),
    //     //     end: new Date(y, m, d, 14, 0),
    //     //     allDay: false
    //     // }, {
    //     //     title: 'Birthday Party',
    //     //     start: new Date(y, m, d + 1, 19, 0),
    //     //     end: new Date(y, m, d + 1, 22, 30),
    //     //     allDay: false
    //     // }, {
    //     //     title: 'Click for Google',
    //     //     start: new Date(y, m, 28),
    //     //     end: new Date(y, m, 29),
    //     //     url: 'http://google.com/'
    //     // }]
    // });
});

</script>


@endpush
@section('content')
<div class="row">
    <div id="booking-page" class="col-lg-12">
        <div class="col-lg-2">
            {{-- <div class="xdisplay_inputx form-group has-feedback">
                <input type="text" class="form-control has-feedback-left input-sm" id="date-booking" placeholder="Select date" aria-describedby="inputSuccess2Status3">
                <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                <span id="inputSuccess2Status3" class="sr-only">(success)</span>
            </div> --}}
            <div class="form-group">
                <select class="form-control input-sm select2_group">
                    <option value="">Choose service</option>
                    @foreach ($types as $type)
                        <optgroup label="{{ $type->name }}">
                            @foreach ($type->services as $service)
                                <option value="{{ $service->id }}">Price {{ $service->price }}</option>
                            @endforeach
                        </optgroup>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-lg-10">
            <div id="calendar">
            </div>
        </div>
        @include('front.modals.booking')

    </div>
</div>
@endsection