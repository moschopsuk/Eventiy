@extends(Config::get('syntara::views.master'))

@section('content')
<script src="{{ asset('/js/dashboard/event.js') }}"></script>

<div class="container" id="main-container">
    @include('syntara::layouts.dashboard.confirmation-modal', array('title' => trans('syntara::all.confirm-delete-title'), 'content' => trans('syntara::all.confirm-delete-message'), 'type' => 'delete-event'))
    <div class="row">
        <div class="col-lg-10">
            <section class="module">
                <div class="module-head">
                    <b>Active Screen</b>
                </div>
                <div class="module-body ajax-content">
                    @include('dashboard.screen.list-screens')
                </div>
            </section>
        </div>
        <div class="col-lg-2">
            <section class="module">
                <div class="module-head">
                    <b>Search</b>
                </div>
                <div class="module-body">
                    <form id="search-form" onsubmit="return false;">
                        <div class="form-group">
                            <label for="eventIdSearch">ID</label>
                            <input type="text" class="form-control" id="eventIdSearch" name="eventIdSearch">
                        </div>
                        <div class="form-group">
                            <label for="nameSearch">Name</label>
                            <input type="text" class="form-control" id="nameSearch" name="nameSearch">
                        </div>
                        <div class="form-group">
                            <label for="locationSearch">location</label>
                            <input type="text" class="form-control" id="locationSearch" name="locationSearch">
                        </div>
                        <button type="submit" class="btn btn-primary">{{ trans('syntara::all.search') }}</button>
                    </form>
                </div>
            </section>
        </div>
    </div>
</div>
@stop