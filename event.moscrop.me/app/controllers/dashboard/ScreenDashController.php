<?php

use MrJuliuss\Syntara\Controllers\BaseController;
use Carbon\Carbon;

class ScreenDashController extends BaseController
{

    // add breadcrumb to current page
    static $baseCrumb = array(
        'title' => 'Screens',
        'link' => 'dashboard/screens',
        'icon' => 'glyphicon-tasks'
    );

	/**
    * Show events list
    */
    public function getIndex()
    {
        //Remove any screens which have not be updated in five minutes
        $expired = Screen::where('updated_at', '<=', Carbon::now()->subMinutes(5)->toDateTimeString())->get();

        foreach ($expired as $e) {
            $e->delete();
        }

    	$this->layout = View::make('dashboard/screen/index-screen',
        	array(
        		'screens' => Screen::paginate(15),
        	)
        );

        $this->layout->title = 'Screen Manager';
        // add breadcrumb to current page
        $this->layout->breadcrumb = array(self::$baseCrumb);
    }


    /**
    * View event details
    * @param int $eventId
    */
    public function getShow($screenId)
    {
        $screen = Screen::find($screenId);

        $events = LiveEvent::where('start_time', '<', Carbon::now())
            ->where('end_time', '>', Carbon::now())
            ->get();

        $this->layout = View::make('dashboard/screen/show-screen', array(
            'screen'  => $screen,
            'events'  => $events,
            'layouts' => array('unavailable', 'video', 'general', 'ticker'),
        ));

        $this->layout->title = "Screen " . $screen->id;
        $this->layout->breadcrumb = array(
            self::$baseCrumb,

            array(
                'title' => "Screen " . $screen->id,
                'link' => URL::current(),
                'icon' => 'glyphicon-plus-sign'
            )
        );
    }

    /**
    * update event details
    * @param int $screenId
    */
    public function putShow($screenId)
    {
        $screen = Screen::find($screenId);

        $screen->event_id   = Input::get('event_id');
        $screen->layout     = Input::get('layout');
        $screen->save();

        return Response::json(array('screenUpdated' => true, 'message' => 'Screen details updated', 'messageType' => 'success'));
    }
}

?>