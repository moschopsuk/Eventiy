<?php

use Carbon\Carbon;

class EventIndexController extends Controller {

	public function getLiveEvents()
	{
		$events = LiveEvent::where('start_time', '<', Carbon::now())
    		->where('end_time', '>', Carbon::now())
    		->get();

		return Response::json($events);
	}

	public function getSingleLiveEvents($id)
	{
		$event = LiveEvent::find($id);
		return Response::json($event);
	}

	public function getArchived()
	{
		$events = LiveEvent::where('end_time', '<', Carbon::now())
			->orderBy('created_at', 'DESC')
    		->get();

		return Response::json($events);
	}
	

}

?>