<?php namespace App\Models\ReferentialModels;

use Illuminate\Database\Eloquent\Model;

class Provider extends Model {

	protected $fillable=['description',
                         'web',
                         'mail',
                         'tel',
                         'direcc',
                         'razon',
                         'ruc'];

    public function product(){
        return $this->hasMany('App\Models\ReferentialModels\Product');
    }
}
