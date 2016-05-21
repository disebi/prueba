<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Staff extends \Eloquent {

    protected  $fillable = [
        'user_id',
        'branch_id',
        'position_id',
        'ci',
        'name',
        'last_name',
        'tel',
        'direcc',
        'birth_date',
    ];
    public function user(){
        return $this->belongsTo('App\User');
    }

    public function getUserListAttribute(){
        return $this->user()->lists('id');
    }

    public function branch(){
        return $this->belongsTo('App\Models\ReferentialModels\Branch');
    }

    public function getBranchListAttribute(){

        return $this->branch()->lists('id');
    }

    public function position(){

        return $this->belongsTo('App\Models\ReferentialModels\Position');
    }

    public function getPositionListAttribute(){

        return $this->position()->lists('id');
    }


    public function zones(){
        return $this->belongsToMany('App\Models\ReferentialModels\Zone','zone_assigns','staff_id','zone_id','id')->withTimestamps();
    }

    public function  getZonesListAttribute(){
        return $this->zones()->lists('id');
    }

    public function scopeBranching($query)
    {
        $user=\Auth::user();
        return $query->where('staff.branch_id','=',$user->staff->branch_id);
    }

    public function objective()
    {
        return $this->zones->sum('obj');
    }
}
