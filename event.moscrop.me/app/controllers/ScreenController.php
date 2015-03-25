<?php

class ScreenController extends Controller {

	public function putScreen() {
		$screen = Screen::firstOrNew(array('display_id' => Input::get('display_id')));
		$screen->save();
		$screen->touch();

		if($screen->event()->exists()) {
			return Response::json(array('ready' => true, 'layout' => $screen->layout, 'event' => $screen->event));
		} else {
			return Response::json(array('ready' => false, 'layout' => $screen->layout));
		}
	}

}

?>