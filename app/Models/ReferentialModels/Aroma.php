<?php namespace App\Models\ReferentialModels;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Aroma extends Model {
    protected $table ='aromas';
    protected $fillable =['description'];

    public function product(){
        return $this->hasMany('App\Models\ReferentialModels\Product');
    }
}
