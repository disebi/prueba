<?php namespace App\Models\Distribution;

use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model {

    protected $fillable=[   'order_id',
        'product_id',
        'cant',
        'price'
    ];

    public function product(){
        return $this->belongsTo('App\Models\ReferentialModels\Product');
    }

    public function order(){
        return $this->belongsTo('App\Models\Distribution\Order');
    }


}
