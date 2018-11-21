class Booking {
    constructor() {
        this.calendar = null;
        this.serviceId = null;
    };
    initDatepicker() {
        $('#date-booking').daterangepicker({
            singleDatePicker: true,
        }, function(start, end, label) {
        });
    };
    initSelect2() {
        $(".select2_group").select2({});
    };
    initCalendar(data) {
        // console.log('CC');
        // console.log(data);
        var date = new Date(),
        d = date.getDate(),
        m = date.getMonth(),
        y = date.getFullYear(),
        started,
        categoryClass;

        // console.log('00:20');
        // console.log(data.duration_hours);
        var calendar = $('#calendar').fullCalendar({
            header: {
                left: 'prev,next',
                center: 'title',
                right: 'agendaWeek,agendaDay'
            },
            defaultView: 'agendaWeek',
            selectable: true,
            selectHelper: true,
            slotDuration: data.duration_hours,
            selectAllow: function(selectInfo) {
                var duration = moment.duration(selectInfo.end.diff(selectInfo.start));
                return duration.asSeconds() <= data.duration;
            },
            select: function(start, end, allDay) {
                booking.showBookingModal(start, end);
            },
            validRange: {
                start: moment(),
                end: data.to
            },
            eventClick: function(calEvent, jsEvent, view) {
                // console.log('eventClick');
                // $('#fc_edit').click();
                // $('#title2').val(calEvent.title);

                // categoryClass = $("#event_type").val();

                // $(".antosubmit2").on("click", function() {
                //     calEvent.title = $("#title2").val();

                //     calendar.fullCalendar('updateEvent', calEvent);
                //     $('.antoclose2').click();
                // });

                // calendar.fullCalendar('unselect');
            },
            // editable: true,
            // events: [{
            //     title: 'All Day Event',
            //     start: new Date(y, m, 1)
            // }, {
            //     title: 'Long Event',
            //     start: new Date(y, m, d - 5),
            //     end: new Date(y, m, d - 2)
            // }, {
            //     title: 'Meeting',
            //     start: new Date(y, m, d, 10, 30),
            //     allDay: false
            // }, {
            //     title: 'Lunch',
            //     start: new Date(y, m, d + 14, 12, 0),
            //     end: new Date(y, m, d, 14, 0),
            //     allDay: false
            // }, {
            //     title: 'Birthday Party',
            //     start: new Date(y, m, d + 1, 19, 0),
            //     end: new Date(y, m, d + 1, 22, 30),
            //     allDay: false
            // }, {
            //     title: 'Click for Google',
            //     start: new Date(y, m, 28),
            //     end: new Date(y, m, 29),
            //     url: 'http://google.com/'
            // }]
            });
        this.calendar = calendar;
    };
    showBookingModal(start, end) {
        let modal = $('#booking-modal');
        modal.find('#booking-date').val(start.format('DD.MM.YYYY'))
        modal.find('#booking-time-from').val(start.format('HH:mm'))
        modal.find('#booking-time-to').val(end.format('HH:mm'))
        $('#booking-modal').modal('show');
    }
    changeServise(e) {
        let serviceID = $(this).val();
        if(serviceID == '') {
            //hide calendar
        } else {
            $.ajax({
                url: '/ajax/booking/'+serviceID,
                method: 'GET',
                dataType: 'json',
                success: data => {
                    booking.serviceId = data.data.id;
                    console.log(booking.serviceId);
                    booking.initCalendar(data.data);
                }
            });
        }
    };
    sendBooking(e) {
        let form = $('#booking-form');
        let sendData = form.serialize();

        // console.log(booking);
        // console.log(booking.serviceId);
        // console.log(booking.serviceId);
        $.ajax({
            url: '/ajax/booking/'+booking.serviceId,
            method: 'POST',
            data: sendData,
            dataType: 'json',
            success: data => {
                console.log('success');
                // booking.initCalendar(data.data);
            },
            statusCode: {
                422: function(xhr) {
                    var data = JSON.parse(xhr.responseText);
                    console.log(data);
                    for (const i in data.errors) {
                        let input = form.find('input[name='+i+']');
                        console.log(input);
                        input.closest('.form-group').addClass('has-error');
                        input.next('.help-block').text(data.errors[i][0]);
                    }
                }
            }

        });
    }
    initActions() {
        $("#booking-page").on('change', '.select2_group', this.changeServise);
        $("#booking-page").on('click', '#booking-form-submit', this.sendBooking);
    };
    init() {
        this.initDatepicker();
        this.initSelect2();
        this.initActions();
    }
}
let booking = new Booking();
booking.init();