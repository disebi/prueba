<?php namespace App\Models\Distribution;

use Illuminate\Database\Eloquent\Model;

class SaleDetails extends \Eloquent {

    protected $fillable=[   'sale_id',
        'product_id',
        'cant',
        'price'
    ];

    public function product(){
        return $this->belongsTo('App\Models\ReferentialModels\Product');
    }

    public function order(){
        return $this->belongsTo('App\Models\Distribution\Sale');
    }


}
