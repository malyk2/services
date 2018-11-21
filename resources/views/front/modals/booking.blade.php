<div id="booking-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">Booking</h4>
            </div>
            <div class="modal-body">
                <div id="" style="padding: 5px 20px;">
                    <form id="booking-form" class="form-horizontal calender" role="form">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Date</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="booking-date" name="date" value="" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Time</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="booking-time-from" name="time_from" value="" readonly>
                            </div>
                            <div class="col-sm-1"></div>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="booking-time-to" name="time_to" value="" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Email</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="email" name="email">
                                <span class="help-block">Enter your contact email</span>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default antoclose" data-dismiss="modal">Close</button>
                <button type="button" id="booking-form-submit" class="btn btn-primary antosubmit">Booking</button>
            </div>
        </div>
    </div>
</div>