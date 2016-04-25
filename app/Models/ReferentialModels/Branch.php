<?php namespace App\Models\ReferentialModels;

use Illuminate\Database\Eloquent\Model;

class Branch extends \Eloquent {

	protected $fillable=['description','tel','mail','direcc'];


    public function deposit(){
        return $this->hasOne('App\Models\ReferentialModels\Deposit');
    }

    public function visit(){
        return $this->hasMany('App\Models\Distribution\Visit');
    }

    public function orders()
    {
        return $this->hasMany('App\Models\Distribution\Order');
    }
}

