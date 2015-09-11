<?php namespace App\Models\ReferentialModels;

use Illuminate\Database\Eloquent\Model;

class Tax extends Model {

	protected $fillable=['id','description','valor'];

    public function product(){
        return $this->hasMany('App\Models\ReferentialModels\Product');
    }
}
