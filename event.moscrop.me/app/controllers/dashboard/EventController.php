<?php

use MrJuliuss\Syntara\Controllers\BaseController;

class EventController extends BaseController
{

	// add breadcrumb to current page
    static $baseCrumb = array(
        'title' => 'Events',
        'link' => 'dashboard/events',
        'icon' => 'glyphicon-calendar'
    );


	/**
    * Show events list
    */
    public function getIndex()
    {
    	$allEvents = LiveEvent::paginate(15);

    	//HTML content for AJAX reload
    	if(Request::ajax())
        {
            $html = View::make('dashboard/event/list-events', array('events' => $allEvents))->render();
            return Response::json(array('html' => $html));
        }


        $this->layout = View::make('dashboard/event/index-event',
        	array(
        		'events' => $allEvents
        	)
        );

        $this->layout->title = 'Event Manager';

        // add breadcrumb to current page
        $this->layout->breadcrumb = array(self::$baseCrumb);
    }

    /**
    * Show new event form view
    */
    public function getCreate()
    {
        $this->layout = View::make('dashboard/event/new-event');
        $this->layout->title = 'New Event';
        $this->layout->breadcrumb = array(
        	self::$baseCrumb,

        	array(
        		'title' => 'New Event',
        		'link' => 'dashboard/event/new',
        		'icon' => 'glyphicon-plus-sign'
        	)
        );
    }

    /**
    * Create new user
    */
    public function postCreate()
    {

    	$event = new LiveEvent;

    	$event->name = Input::get('name');
    	$event->location = Input::get('location');
    	$event->description = Input::get('description');
    	$event->start_time = Input::get('start_time');
    	$event->end_time = Input::get('end_time');

    	$event->save();

    	return json_encode(array('eventCreated' => true, 'redirectUrl' => URL::route('view-list-events')));
    }

    /**
     * Delete event
     * @param  int $userId
     * @return  Response
     */
    public function delete($eventId)
    {
        $event = LiveEvent::find($eventId);
        $event->delete();
        return Response::json(array('deletedEvent' => true, 'message' => 'Event Deleted', 'messageType' => 'success'));
    }

    /**
    * View event details
    * @param int $eventId
    */
    public function getShow($eventId)
    {
        $event = LiveEvent::find($eventId);

        $this->layout = View::make('dashboard/event/show-event', array(
            'event' => $event,
        ));

        $this->layout->title = $event->name;
        $this->layout->breadcrumb = array(
            self::$baseCrumb,

            array(
                'title' => $event->name,
                'link' => URL::current(),
                'icon' => 'glyphicon-plus-sign'
            )
        );
    }

    /**
    * update event details
    * @param int $eventId
    */
    public function putShow($eventId)
    {
        $event = LiveEvent::find($eventId);

        $event->name = Input::get('name');
        $event->location = Input::get('location');
        $event->description = Input::get('description');
        $event->start_time = Input::get('start_time');
        $event->end_time = Input::get('end_time');

        $event->save();

        return Response::json(array('eventUpdated' => true, 'message' => 'Event details updated', 'messageType' => 'success'));
    }
}

?>