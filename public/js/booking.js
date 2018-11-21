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
        let startDate = moment(data.from) < moment() ? moment().subtract(1, 'days') : moment(data.from);
        var calendar = $('#calendar').fullCalendar({
            header: {
                left: 'prev,next',
                center: 'title',
                right: 'agendaWeek,agendaDay'
            },
            defaultView: 'agendaWeek',
            dateAlignment: startDate,
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
                start: startDate,
                end: moment(data.to).add(1, 'days')
            },
            events: data.events,
            });
        this.calendar = calendar;
    };
    destroyCalendar(){
        if(this.calendar) {
            this.calendar.fullCalendar('destroy');
        }
    }
    showBookingModal(start, end) {
        let modal = $('#booking-modal');
        modal.find('#booking-date').val(start.format('DD.MM.YYYY'))
        modal.find('#booking-time-from').val(start.format('HH:mm'))
        modal.find('#booking-time-to').val(end.format('HH:mm'))
        $('#booking-modal').modal('show');
    }
    changeServise(e) {
        let serviceID = $(this).val();
        booking.destroyCalendar();
        if(serviceID !== '') {
            $.ajax({
                url: '/ajax/booking/'+serviceID,
                method: 'GET',
                dataType: 'json',
                success: data => {
                    booking.serviceId = data.data.id;
                    booking.initCalendar(data.data);
                }
            });
        }
    };
    sendBooking(e) {
        let form = $('#booking-form');
        let sendData = form.serialize();

        $.ajax({
            url: '/ajax/booking/'+booking.serviceId,
            method: 'POST',
            data: sendData,
            dataType: 'json',
            success: data => {
                booking.calendar.fullCalendar('renderEvent', data,true);
                $('#booking-modal').modal('hide');
                app.pnotify('Success', 'Booking saved', 'success');
            },
            statusCode: {
                422: function(xhr) {
                    var data = JSON.parse(xhr.responseText);
                    for (const i in data.errors) {
                        let input = form.find('input[name='+i+']');
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
        // this.initDatepicker();
        this.initSelect2();
        this.initActions();
    }
}
let booking = new Booking();
booking.init();