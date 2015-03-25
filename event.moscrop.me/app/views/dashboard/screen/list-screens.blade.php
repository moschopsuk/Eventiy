<div class="row upper-menu">
    {{ $screens->links(); }}
</div>

<table class="table table-striped table-bordered table-condensed">
<thead>
    <tr>
        <th class="col-lg-1 hidden-xs" style="text-align: center;">Id</th>
        <th class="col-lg-1">Display ID</th>
        <th class="col-lg-2">Event</th>
        <th class="col-lg-2">Layout</th>
        <th class="col-lg-2">created</th>
        <th class="col-lg-2">Last Ping</th>
        <th class="col-lg-1" style="text-align: center;">Show</th>
    </tr>
</thead>
<tbody>
    @foreach ($screens as $screen)
    <form>
    <tr>
        <td class="col-lg-1">{{ $screen->id }}</th>
        <td class="col-lg-1">{{ $screen->display_id }}</th>
        <td class="col-lg-1">{{ $screen->event->name or "None Assgined"}}
        <td class="col-lg-1">{{ $screen->layout }}</td>
        <td class="col-lg-1">{{ $screen->created_at->diffForHumans() }}</th>
        <td class="col-lg-1">{{ $screen->updated_at->diffForHumans() }}</th>
        <td style="text-align: center;">&nbsp;<a href="{{ URL::route('show-screen', $screen->id) }}">{{ trans('syntara::all.show') }}</a></td>
    </tr>
    @endforeach
</tbody>
</table>
