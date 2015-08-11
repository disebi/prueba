<?php namespace App\Models\ReferentialModels;

use Illuminate\Database\Eloquent\Model;

class Drive extends Model {

    protected $fillable =['description','chapa','chasis','year','brand_id'];

    public function brand(){
        return $this->belongsTo('App\Models\ReferentialModels\Brand');
    }

    public function getBrandListAttribute(){

        return $this->brand()->lists('id');
    }

}
