@extends(Config::get('syntara::views.master'))

@section('content')
<script src="{{ asset('/js/dashboard/screen.js') }}"></script>

<div class="container" id="main-container">
    <div class="row">
        <div class="col-lg-12">
            <section class="module">
                <div class="module-head">
                    <b>Screen: {{ $screen->display_id }}#</b>
                </div>
                <div class="module-body">
                    <form class="form-horizontal" id="edit-screen-form" method="PUT">
                        <div class="row">
                            <div class="col-lg-6">
                                 <div class="form-group">
                                    <label class="control-label">Event ID</label>
                                    <p>
                                        <select class="col-lg-12 form-control" id="event_id" name="event_id">
                                            <option value="">-----------</option>
                                        @foreach ($events as $event)
                                            <option value="{{ $event->id }}" {{{ $event->id == $screen->event_id ? 'selected' : '' }}}>{{ $event->name }}</option>
                                        @endforeach
                                        </select>
                                    </p>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Layout</label>
                                    <select class="col-lg-12 form-control" id="layout" name="layout">
                                        <option value="">-----------</option>
                                    @foreach ($layouts as $layout)
                                        <option value="{{ $layout }}" {{{ $layout == $screen->layout ? 'selected' : '' }}}>{{ $layout }}</option>
                                    @endforeach
                                    </select>
                                </div>                              
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <button id="update-screen" class="btn btn-primary" style="margin-top: 15px;">{{ trans('syntara::all.update') }}</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </div>
</div>
@stop