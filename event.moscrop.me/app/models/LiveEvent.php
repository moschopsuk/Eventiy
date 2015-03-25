<?php

class LiveEvent extends Eloquent {

	protected $table = 'events';

	protected $visible = array('id', 'name', 'description', 'hashtag', 'video_stream', 'cover_url', 'location', 'start_time', 'end_time');

	public function posts()
    {
    	return $this->hasMany('Post', 'event_id');
    }
}

?>