<?php namespace App\Models\ReferentialModels;

use Illuminate\Database\Eloquent\Model;

class Branch extends \Eloquent {

	protected $fillable=['description','tel','mail','direcc'];


    public function deposit(){
        return $this->hasOne('App\Models\ReferentialModels\Deposit');
    }
    public function city(){
        return $this->hasOne('App\Models\ReferentialModels\City');
    }

    public function visit(){
        return $this->hasMany('App\Models\Distribution\Visit');
    }

    public function orders()
    {
        return $this->hasMany('App\Models\Distribution\Order');
    }
    public function staff()
    {
        return $this->hasMany('App\Staff');
    }

    public function objective()
    {
        return $this->city->zone->sum('obj');
    }
}

