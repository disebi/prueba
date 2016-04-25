<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\ReferentialModels\Aroma;
use App\Models\ReferentialModels\Brand;
use App\Models\ReferentialModels\Unity;
use App\Models\ReferentialModels\Business;
use App\Models\ReferentialModels\Presentation;
use App\Models\ReferentialModels\Line;
use Illuminate\Http\Request;

class ModalController extends Controller {

	public function brand()
    {
        $input=\Input::all();
        $description=$input['value'];
        $input['description']=$description;
        unset($input['pk']);
        unset($input['name']);
        unset($input['value']);
        unset($input['_token']);
        $number=Brand::where('description','=',$input['description'])->count();

        if($number==0){
            Brand::create($input);
            $html=Brand::select('id','description')->get();
            return $html;
        }else{
            return 0;
        }
    }

    public function buss()
    {
        $input=\Input::all();
        $description=$input['value'];
        $input['description']=$description;
        unset($input['pk']);
        unset($input['name']);
        unset($input['value']);
        unset($input['_token']);
        $number=Business::where('description','=',$input['description'])->count();

        if($number==0){
            Business::create($input);
            $html=Business::select('id','description')->get();
            return $html;
        }else{
            return 0;
        }
    }

    public function line()
    {
        $input=\Input::all();
        $description=$input['value'];
        $input['description']=$description;
        unset($input['pk']);
        unset($input['name']);
        unset($input['value']);
        unset($input['_token']);
        $number=Line::where('description','=',$input['description'])->count();

        if($number==0){
            Line::create($input);
            $html=Line::select('id','description')->get();
            return $html;
        }else{
            return 0;
        }
    }
	public function provider(){

    }


    public function presentation()
    {
        $input=\Input::all();
        $description=$input['value'];
        $input['description']=$description;
        unset($input['pk']);
        unset($input['name']);
        unset($input['value']);
        unset($input['_token']);
        $number=Presentation::where('description','=',$input['description'])->count();

        if($number==0){
            Presentation::create($input);
            $html=Presentation::select('id','description')->get();
            return $html;
        }else{
            return 0;
        }
    }


    public function unity()
    {
        $input=\Input::all();
        $description=$input['value'];
        $input['description']=$description;
        unset($input['pk']);
        unset($input['name']);
        unset($input['value']);
        unset($input['_token']);
        $number=Unity::where('description','=',$input['description'])->count();

        if($number==0){
            Unity::create($input);
            $html=Unity::select('id','description')->get();
            return $html;
        }else{
            return 0;
        }
    }

    public function aroma()
    {
        $input=\Input::all();
        $description=$input['value'];
        $input['description']=$description;
        unset($input['pk']);
        unset($input['name']);
        unset($input['value']);
        unset($input['_token']);
        $number=Aroma::where('description','=',$input['description'])->count();

        if($number==0){
            Aroma::create($input);
            $html=Aroma::select('id','description')->get();
            return $html;
        }else{
            return 0;
        }
    }

}
