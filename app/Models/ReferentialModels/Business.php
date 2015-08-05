<?php namespace App\Models\ReferentialModels;

use Illuminate\Database\Eloquent\Model;

class Business extends \Eloquent {

    protected $fillable =['description'];

    public function locals(){

        return $this->hasMany('App\Models\ReferentialModels\Local','business_id');
    }


    public function getLocalListAttribute(){

        return $this->locals()->lists('id');
    }
}
