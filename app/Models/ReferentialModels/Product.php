<?php namespace App\Models\ReferentialModels;

use Illuminate\Database\Eloquent\Model;

class Product extends Model {

	protected $fillable=[];
    //taxes
    public function tax(){
        return $this->belongsTo('App\Models\ReferentialModels\Tax');
    }
    public function getTaxListAttribute(){
        return $this->tax()->lists('id');
    }

    //presentation
    public function presentation(){
        return $this->belongsTo('App\Models\ReferentialModels\Presentation');
    }
    public function getPresentationListAttribute(){
        return $this->presentation()->lists('id');
    }

    //lines
    public function line(){
        return $this->belongsTo('App\Models\ReferentialModels\Line');
    }
    public function getLineListAttribute(){
        return $this->line()->lists('id');
    }

    //provider
    public function provider(){
        return $this->belongsTo('App\Models\ReferentialModels\Provider');
    }
    public function getProviderListAttribute(){
        return $this->provider()->lists('id');
    }

    //aroma
    public function aroma(){
        return $this->belongsTo('App\Models\ReferentialModels\Aroma');
    }
    public function getAromaListAttribute(){
        return $this->aroma()->lists('id');
    }

    //unity
    public function unity(){
        return $this->belongsTo('App\Models\ReferentialModels\Unity');
    }
    public function getUnityListAttribute(){
        return $this->unity()->lists('id');
    }
}
