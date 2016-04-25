<?php namespace App\Models\Stock;

use Illuminate\Database\Eloquent\Model;

class Adjust extends Model {

    protected $fillable=[
        'branch_id',
        'staff_id',
        'state',
        'coment'
    ];

    public function  products(){
        return $this->belongsToMany('App\Models\ReferentialModels\Product','adjust_details','adjust_id','product_id','id')->withTimestamps();
    }
    public function  details(){
        return $this->hasMany('App\Models\Stock\AdjustDetails','adjust_id');
    }

    public function  staff(){
        return $this->belongsTo('App\Staff');
    }

}
