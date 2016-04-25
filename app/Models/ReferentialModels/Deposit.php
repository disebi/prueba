<?php namespace App\Models\ReferentialModels;

use Illuminate\Database\Eloquent\Model;

class Deposit extends \Eloquent {

    protected  $fillable=['description','branch_id'];
    public function branch(){

        return $this->belongsTo('App\Models\ReferentialModels\Branch');
    }

    public function getBranchListAttribute(){

        return $this->branch()->lists('id');
    }

    public function  products(){
        return $this->belongsToMany('App\Models\ReferentialModels\Product','stocks','deposit_id','product_id','id')->withTimestamps();
    }

}

