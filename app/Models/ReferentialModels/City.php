<?php namespace App\Models\ReferentialModels;

use Illuminate\Database\Eloquent\Model;

class City extends Model {


    protected $fillable =['description','branch_id'];

    public function zone()
    {
        return $this->hasMany('App\Models\ReferentialModels\Zone');
    }

    public function branch(){
     return $this->belongsTo('App\Models\ReferentialModels\Branch');
    }

    public function getBranchListAttribute(){

        return $this->branch()->lists('id');
    }


    public function assign()
    {
        return $this->hasManyThrough('App\Models\Distribution\ZoneAssign','App\Models\ReferentialModels\Zone');
    }
}
