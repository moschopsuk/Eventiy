<?php
class Screen extends Eloquent {

    protected $table = 'screens';

    protected $fillable = array('display_id');

    public function event() {
    	return $this->hasOne('LiveEvent', 'id', 'event_id');
    }
}
?>