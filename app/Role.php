<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model {

	protected $fillable=['description'];


    function  license(){

        $this->belongsToMany('App/License');
    }
}
