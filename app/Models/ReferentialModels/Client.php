<?php namespace App\Models\ReferentialModels;

use Illuminate\Database\Eloquent\Model;

class Client extends \Eloquent {


protected $fillable=["description",
                    "ruc",
                    "razon",
                    "nombre",
                    "apellido",
                    "tel",
                    "direcc",
                    "zona_id",
                    "rubro_id"];



public function zone ()
{
    return $this->belongsTo('App\Models\ReferentialModels\Zone','zona_id');
}

    public function business ()
    {
        return $this->belongsTo('App\Models\ReferentialModels\Business','rubro_id');
    }


 public function getZoneListAttribute(){

    return $this->zone()->lists('id');
}


    public function getBusinessListAttribute(){

        return $this->business()->lists('id');
    }

}
