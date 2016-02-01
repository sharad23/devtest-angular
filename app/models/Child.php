<?php

class Child extends \Eloquent {
	protected $fillable = [];

	public function institutes(){

           return $this->belongsToMany('Institute', 'child_institute', 'child_id', 'institute_id');

    }
}