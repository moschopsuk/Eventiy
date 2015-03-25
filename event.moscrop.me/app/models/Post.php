<?php

class Post extends Eloquent {

    protected $table = 'posts';

    protected $visible = array('id', 'event_id', 'user_id', 'created_at', 'payload_type');

    public function postable()
    {
        return $this->morphTo();
    }
}

?>