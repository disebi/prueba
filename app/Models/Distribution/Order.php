<?php namespace App\Models\Distribution;

use Illuminate\Database\Eloquent\Model;

class Order extends \Eloquent {

    protected $fillable=[
        'visit_id',
        'client_id',
        'staff_id',
        'branch_id',
        'process',
        'state',
        'coment'];

    public function  products(){
        return $this->belongsToMany('App\Models\ReferentialModels\Product','order_details','order_id','product_id','id')->withTimestamps();
    }
    public function  details(){
        return $this->hasMany('App\Models\Distribution\OrderDetails','order_id');
    }

    public function  visits(){
        return $this->belongsTo('App\Models\Distribution\Visit','visit_id');
    }

    public function  client(){
        return $this->belongsTo('App\Models\ReferentialModels\Client','client_id');
    }


    public function getClientListAttribute(){

        return $this->client()->lists('id');
    }


    public function  branching(){
        return $this->belongsTo('App\Models\ReferentialModels\Branch','branch_id');
    }

    public function  staff(){
        return $this->belongsTo('App\Staff','staff_id');
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

    public function scopePendent($query)
    {
        $user=\Auth::user();
        return $query->where('process','=',2);
    }

    public function getWeit()
    {
        $total = 0;

        foreach($this->details as $detail){
              $total=$total+($detail->cant *$detail->product->peso);
        }
        return $total;
    }
}
