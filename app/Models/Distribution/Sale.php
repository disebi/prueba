<?php namespace App\Models\Distribution;

use Illuminate\Database\Eloquent\Model;

class Sale extends \Eloquent {

    protected $fillable=[
        'branch_id',
        'client_id',
        'order_id',
        'staff_id',
        'salesman_id',
        'iva_10',
        'iva_5',
        'exent',
        'total',
        'state',
        'stamping',
        'coment'];

    public function  products(){
        return $this->belongsToMany('App\Models\ReferentialModels\Product','sale_details','sale_id','product_id','id')->withTimestamps();
    }
    public function  details(){
        return $this->hasMany('App\Models\Distribution\SaleDetails','sale_id');
    }

    public function  getProductListAttribute(){
        return $this->product()->lists('id');
    }

    public function getClientListAttribute(){

        return $this->client()->lists('id');
    }
    public function client(){
        return $this->belongsTo('App\Models\ReferentialModels\Client');
    }

    public function order(){
        return $this->belongsTo('App\Models\Distribution\Order');
    }

    public function  staff(){
        return $this->belongsTo('App\Staff','staff_id');
    }

    public function  salesman(){
        return $this->belongsTo('App\Staff','salesman_id');
    }

    public function scopeActive($query)
    {
        return $query->where('sales.state','=',true);
    }
    public function scopeBranching($query)
    {
        $user=\Auth::user();
        return $query->where('sales.branch_id','=',$user->staff->branch_id);
    }

    public function stamp()
    {
        $stamp  = $this->stamping;
        while(strlen($stamp)!=8 && strlen($stamp)<8 ){
            $stamp= '0'.$stamp;
        }
        $stamp= $this->branch_id.'-01-'.$stamp;
        return $stamp;
    }
    public function  credit(){
        return $this->hasMany('App\Models\Stock\Credit','sales_id');
    }

    public function commission()
    {
       return ($this->total * $this->order->visits->zone->comision)/100;
    }
}
