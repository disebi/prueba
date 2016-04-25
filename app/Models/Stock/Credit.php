<?php namespace App\Models\Stock;

use Illuminate\Database\Eloquent\Model;

class Credit extends Model {

    protected $fillable=[
        'branch_id',
        'client_id',
        'sale_id',
        'staff_id',
        'total',
        'state',
        'coment'];

    public function  products(){
        return $this->belongsToMany('App\Models\ReferentialModels\Product','credit_details','credit_id','product_id','id')->withTimestamps();
    }
    public function  details(){
        return $this->hasMany('App\Models\Stock\CreditDetails','credit_id');
    }

    public function  getProductListAttribute(){
        return $this->product()->lists('id');
    }

    public function getClientListAttribute(){

        return $this->client()->lists('id');
    }
    public function  client(){
        return $this->belongsTo('App\Models\ReferentialModels\Client');
    }

    public function  staff(){
        return $this->belongsTo('App\Staff','staff_id');
    }

    public function  sale(){
        return $this->belongsTo('App\Models\Distribution\Sale','sale_id');
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
