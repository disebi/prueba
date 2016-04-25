<?php namespace App\Models\Stock;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model {

    protected $fillable=[
                        'branch_id',
                        'provider_id',
                        'staff_id',
                        'iva_10',
                        'iva_5',
                        'exent',
                        'total',
                        'state',
                        'stamping',
                        'coment'];

    public function  products(){
        return $this->belongsToMany('App\Models\ReferentialModels\Product','purchase_details','purchase_id','product_id','id')->withTimestamps();
    }
    public function  details(){
        return $this->hasMany('App\Models\Stock\PurchaseDetails','purchase_id');
    }

    public function  getProductListAttribute(){
        return $this->product()->lists('id');
    }

    public function getProviderListAttribute(){

        return $this->provider()->lists('id');
    }
    public function  provider(){
        return $this->belongsTo('App\Models\ReferentialModels\Provider');
    }

    public function  staff(){
        return $this->belongsTo('App\Staff','staff_id');
    }

}
