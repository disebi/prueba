<?php namespace App\Models\Stock;

use Illuminate\Database\Eloquent\Model;

class ReturnNote extends Model {

    protected $table='returns';
    protected $fillable=[
        'branch_id',
        'client_id',
        'staff_id',
        'stamping',
        'coment'];

    public function  products(){
        return $this->belongsToMany('App\Models\ReferentialModels\Product','return_details','return_id','product_id','id')->withTimestamps();
    }
    public function  details(){
        return $this->hasMany('App\Models\Stock\ReturnDetails','return_id');
    }

    public function  client(){
        return $this->belongsTo('App\Models\ReferentialModels\Client','client_id');
    }

    public function  staff(){
        return $this->belongsTo('App\Staff','staff_id');
    }

}
