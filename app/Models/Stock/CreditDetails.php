<?php namespace App\Models\Stock;

use Illuminate\Database\Eloquent\Model;

class CreditDetails extends Model {

    protected $fillable=[
        'credit_id',
        'product_id',
        'cant',
        'price'
    ];

    public function product(){
        return $this->belongsTo('App\Models\ReferentialModels\Product');
    }

    public function credit(){
        return $this->belongsTo('App\Models\Stock\Credit');
    }

}
