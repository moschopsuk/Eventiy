<?php

class Post_Tweet extends Eloquent {

    protected $table = 'posts_tweet';
    public $timestamps = false;
    protected $visible = array('tid', 'tuid', 'name', 'screen_name', 'avatar', 'text');
    protected $fillable = array('tid', 'tuid', 'name', 'screen_name', 'avatar', 'text');

    public function post()
    {
        return $this->morphOne('Post', 'postable');
    }
}

?>