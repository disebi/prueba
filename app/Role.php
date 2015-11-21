<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model {

	protected $fillable=['description'];


    public function  licenses(){
       return $this->belongsToMany('App\License')->withTimestamps();
    }

    public function  getLicenseListAttribute(){
        return $this->licenses()->lists('id');
    }



}
