<?php namespace App\Models\Stock;

use Illuminate\Database\Eloquent\Model;

class AdjustDetails extends Model {

    protected $fillable=[   'purchase_id',
        'product_id',
        'activity',
        'cant',
        'price'
    ];

    public function product(){
        return $this->belongsTo('App\Models\ReferentialModels\Product');
    }

    public function adjust(){
        return $this->belongsTo('App\Models\Stock\Adjust');
    }

}
