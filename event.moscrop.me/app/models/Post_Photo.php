<?php

class Post_Photo extends Eloquent {

    protected $table = 'posts_photo';
    public $timestamps = false;
    protected $guarded = array();
    protected $visible = array('caption', 'filename');
    protected $fillable = array('caption', 'filename');

    public function post()
    {
        return $this->morphOne('Post', 'postable');
    }
}

?>