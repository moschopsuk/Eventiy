<div class="row upper-menu">
    {{ $events->links(); }}
    
    <div style="float:right;">
        @if($currentUser->hasAccess('delete-event'))
        <a id="delete-item" class="btn btn-danger">{{ trans('syntara::all.delete') }}</a>
        @endif

        @if($currentUser->hasAccess('create-event'))
        <a class="btn btn-info btn-new" href="{{ URL::route('create-event') }}">New Event</a>
        @endif
    </div>
</div>
<table class="table table-striped table-bordered table-condensed">
<thead>
    <tr>
        @if($currentUser->hasAccess('delete-event'))
        <th class="col-lg-1" style="text-align: center;"><input type="checkbox" class="check-all"></th>
        @endif
        <th class="col-lg-1 hidden-xs" style="text-align: center;">Id</th>
        <th class="col-lg-1">Name</th>
        <th class="col-lg-3">Description</th>
        <th class="col-lg-1">Location</th>
        <th class="col-lg-1 visible-lg visible-xs">Start</th>
        <th class="col-lg-1 visible-lg visible-xs">End</th>
        <th class="col-lg-1" style="text-align: center;">{{ trans('syntara::all.show') }}</th>
    </tr>
</thead>
<tbody>
    @foreach ($events as $event)
    <tr>
        @if($currentUser->hasAccess('delete-event'))
        <td style="text-align: center;">
            <input type="checkbox" data-event-id="{{ $event->id }}">
        </td>
        @endif
        <td class="col-lg-1 hidden-xs" style="text-align: center;">{{ $event->id }}</th>
        <td class="col-lg-1">{{ $event->name }}</th>
        <td class="col-lg-1">{{ $event->description }}</th>
        <td class="col-lg-1">{{ $event->location }}</th>
        <td class="col-lg-2 visible-lg visible-xs">{{ $event->start_time }}</th>
        <td class="col-lg-2 visible-lg visible-xs">{{ $event->end_time }}</th>
        <td style="text-align: center;">&nbsp;<a href="{{ URL::route('show-event', $event->id) }}">{{ trans('syntara::all.show') }}</a></td>
    </tr>
    @endforeach
</tbody>
</table>
