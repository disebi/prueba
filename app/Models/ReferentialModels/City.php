<?php namespace App\Models\ReferentialModels;

use Illuminate\Database\Eloquent\Model;

class City extends Model {


    protected $fillable =['description'];

    public function zone(){

       return $this->hasMany('App\Models\ReferentialModels\Zone');
    }
}
