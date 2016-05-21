<?php namespace App\Models\Distribution;

use Illuminate\Database\Eloquent\Model;

class Back extends Model {

    protected $fillable=[
        'out_id',
        'staff_id',
        'branch_id',
        'km',
        'tanque',
        'comments'];

    public function out(){
        return $this->belongsTo('App\Models\Distribution\Out','out_id');
    }

    public function branch(){
        return $this->belongsTo('App\Models\ReferentialModels\Branch','branch_id');
    }

    public function staff(){
        return $this->belongsTo('App\Staff','staff_id');
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
}
