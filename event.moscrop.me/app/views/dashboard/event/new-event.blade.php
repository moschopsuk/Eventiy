@extends(Config::get('syntara::views.master'))

@section('header-css')
<link rel="stylesheet" media="screen" href="{{ asset('/css/datetimepicker.min.css') }}" >
@stop

@section('content')
<script src="{{ asset('/lib/moment.js') }}"></script>
<script src="{{ asset('/lib/datetimepicker.min.js') }}"></script>
<script src="{{ asset('/js/dashboard/event.js') }}"></script>


<div class="container" id="main-container">
    <div class="row">
        <div class="col-lg-12">
            <section class="module">
                <div class="module-head">
                    <b>New Event</b>
                </div>
                <div class="module-body">
                    <form class="form-horizontal" id="create-event-form" method="POST">
                        <div class="row">
                            <div class="col-lg-6">
                                 <div class="form-group">
                                    <label class="control-label">Name</label>
                                    <p><input class="col-lg-12 form-control" type="text" placeholder="Name" id="name" name="name"></p>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Location</label>
                                    <p><input class="col-lg-12 form-control" type="text" placeholder="Location" id="location" name="location"></p>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Description</label>
                                    <p><textarea class="col-lg-12 form-control" rows="5" id="description" name="description"></textarea></p>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Start Time</label>
                                    <div class="input-group date" id="startTime">
                                        <input type='text' class="form-control" id="start_time" name="start_time" data-date-format="YYYY-MM-DD HH:mm:00" />
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Finish Time</label>
                                    <div class="input-group date" id="endTime">
                                        <input type="text" class="form-control" id="end_time" name="end_time" data-date-format="YYYY-MM-DD HH:mm:00" />
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <button id="add-event" class="btn btn-primary" style="margin-top: 15px;">{{ trans('syntara::all.create') }}</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </div>
</div>

<script>
    $('#startTime').datetimepicker();
    $('#endTime').datetimepicker();
</script>
@stop