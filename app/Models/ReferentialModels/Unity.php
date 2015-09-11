<?php namespace App\Models\ReferentialModels;

use Illuminate\Database\Eloquent\Model;

class Unity extends Model {

    protected $fillable =['description'];

    public function product(){
        return $this->hasMany('App\Models\ReferentialModels\Product');
    }
}
