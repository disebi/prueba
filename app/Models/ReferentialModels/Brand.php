<?php namespace App\Models\ReferentialModels;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model {

    protected $fillable =['description'];


    public function drive(){
        return $this->hasMany('App\Models\ReferentialModels\Drive');
    }

}
