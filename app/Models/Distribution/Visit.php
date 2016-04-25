<?php namespace App\Models\Distribution;

use Illuminate\Database\Eloquent\Model;

class Visit extends \Eloquent {
    protected $fillable=[
                    'zone_id',
                    'branch_id',
                    'delivery_date',
                    'state',
                    'process' ];

    public function  orders(){
        return $this->hasMany('App\Models\Distribution\Order');
    }

    public function  branch(){
        return $this->belongsTo('App\Models\ReferentialModels\Branch');
    }

    public function  staff(){
        return $this->belongsTo('App\Staff');
    }

    public function  zone(){
        return $this->belongsTo('App\Models\ReferentialModels\Zone');
    }

    public function details()
    {
        return $this->hasManyThrough('App\Models\Distribution\OrderDetails', 'App\Models\Distribution\Order');
    }

    public function actives($query)
    {
        return $query->where('state','=',true);
    }

    public function scopeActive($query)
    {
        return $query->where('state','=',true);
    }
    public function scopeBranching($query)
    {
        $user=\Auth::user();
        return $query->where('branch_id','=',$user->staff->branch_id);
    }
}
