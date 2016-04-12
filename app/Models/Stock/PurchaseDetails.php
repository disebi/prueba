<?php namespace App\Models\Stock;

use Illuminate\Database\Eloquent\Model;

class PurchaseDetails extends Model {

	protected $fillable=[   'purchase_id',
                            'product_id',
                            'cant',
                            'price'
                            ];

    public function product(){
        return $this->belongsTo('App\Models\ReferentialModels\Product');
    }

    public function purchase(){
        return $this->belongsTo('App\Models\Stock\Purchase');
    }


}
