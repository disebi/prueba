<?php namespace App\Models\Distribution;

use Illuminate\Database\Eloquent\Model;

class WorkOrder extends Model {

    protected $fillable=[
        'branch_id',
        'visit_id',
        'staff_id',
        'state',
        'process',
        'comments'];


    public function  details(){
        return $this->hasMany('App\Models\Distribution\WorkOrderDetails','work_order_id');
    }

   public function  branch(){
        return $this->belongsTo('App\Models\ReferentialModels\Branch');
   }
   public function  visit(){
        return $this->belongsTo('App\Models\Distribution\Visit');
   }

    public function  staff(){
        return $this->belongsTo('App\Staff','staff_id');
    }


    public function scopeActive($query)
    {
        return $query->where('work_orders.state','=',true);
    }
    public function scopeBranching($query)
    {
        $user=\Auth::user();
        return $query->where('work_orders.branch_id','=',$user->staff->branch_id);
    }

    public function scopePendent($query)
    {
        return $query->where('work_orders.process','=',0);
    }

    public function scopeAccepted($query)
    {
        return $query->where('work_orders.process','=',1);
    }

    public function setOut()
    {
         $this->process = 2;
        $this->save();
    }
}
