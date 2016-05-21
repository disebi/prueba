<?php namespace App\Models\Stock;

use Illuminate\Database\Eloquent\Model;

class Remission extends Model {


    public function scopeActive($query)
    {
        return $query->where('remissions.state','=',true);
    }
    public function scopeBranching($query)
    {
        $user=\Auth::user();
        return $query->where('remissions.branch_id','=',$user->staff->branch_id);
    }
    public function scopePendent($query)
    {
        $user=\Auth::user();
        return $query->where('remissions.process','=',0);
    }

}
