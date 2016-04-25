<?php namespace App\Models\ReferentialModels;

use Illuminate\Database\Eloquent\Model;

class Zone extends \Eloquent {

	protected $fillable=['id','description','comision','km','city_id','obj'];


    public function city(){

     return $this->belongsTo('App\Models\ReferentialModels\City');
    }

    public function getCityListAttribute(){

    return $this->city()->lists('id');
    }

    public function local(){

        return $this->hasMany('App\Models\ReferentialModels\Client','zona_id');
    }

    public function assign(){

        return $this->hasOne('App\Models\Distribution\ZoneAssign');
    }

}
