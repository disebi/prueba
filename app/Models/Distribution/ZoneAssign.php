<?php namespace App\Models\Distribution;

use Illuminate\Database\Eloquent\Model;

class ZoneAssign extends \Eloquent {

    protected $fillable=[   'zone_id',
        'staff_id'
    ];

    public function zone(){
        return $this->belongsTo('App\Models\ReferentialModels\Zone');
    }

    public function staff(){
        return $this->belongsTo('App\Staff');
    }

}
