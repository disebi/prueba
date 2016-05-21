<?php namespace App\Models\Distribution;

use Illuminate\Database\Eloquent\Model;

class Out extends Model {

    protected $fillable = [
        'drive_id',
        'driver_id',
        'razon',
        'razon_id',
        'work_order',
        'staff_id',
        'km',
        'tanque',
        'comments'
    ];
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

    public function scopeActive($query)
    {
        return $query->where('state','=',true);
    }

    public function scopeBranch($query)
    {
        $user=\Auth::user();
        return $query->where('branch_id','=',$user->staff->branch_id);
    }

    public function scopePendent($query)
    {
        $user=\Auth::user();
        return $query->where('process','=',0);
    }
}
