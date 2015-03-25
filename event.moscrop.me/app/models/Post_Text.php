<?php

class Post_Text extends Eloquent {

    protected $table = 'posts_text';
    public $timestamps = false;
    protected $visible = array('header', 'body');
    protected $fillable = array('header', 'body');

    public function post()
    {
        return $this->morphOne('Post', 'postable');
    }
}

?>