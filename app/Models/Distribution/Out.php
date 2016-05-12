<?php namespace App\Models\Distribution;

use Illuminate\Database\Eloquent\Model;

class Out extends Model {

    public function branch(){
        return $this->belongsTo('App\Models\ReferentialModels\Branch','branch_id');
    }

    public function staff(){
        return $this->belongsTo('App\Staff','staff_id');
    }
    public function driver(){
        return $this->belongsTo('App\Staff','driver_id');
    }
    public function drive(){
        return $this->belongsTo('App\Models\ReferentialModels\Drive','drive_id');
    }
}
