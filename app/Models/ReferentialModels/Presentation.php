<?php namespace App\Models\ReferentialModels;

use Illuminate\Database\Eloquent\Model;

class Presentation extends Model {

    protected $fillable =['description'];

    public function product(){
        return $this->hasMany('App\Models\ReferentialModels\Product');
    }

}
