<?php

class Institute extends \Eloquent {
	protected $fillable = [];
	public function children(){

           return $this->belongsToMany('Child', 'child_institute', 'institute_id', 'child_id');

    }
}