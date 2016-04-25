<?php namespace App\Models\Stock;
use Illuminate\Database\Eloquent\Model;

class ReturnDetails extends Model {

    protected $fillable=[   'return_id',
        'product_id',
        'cant'
    ];

    public function product(){
        return $this->belongsTo('App\Models\ReferentialModels\Product');
    }

    public function returnNote(){
        return $this->belongsTo('App\Models\Stock\ReturnNote');
    }

}
