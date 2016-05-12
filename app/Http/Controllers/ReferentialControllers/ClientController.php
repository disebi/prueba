<?php namespace App\Http\Controllers\ReferentialControllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\ReferentialModels\Business;
use App\Models\ReferentialModels\City;
use App\Models\ReferentialModels\Client;
use App\Models\ReferentialModels\Zone;
use Illuminate\Http\Request;

class ClientController extends Controller {


    public function __construct()
    {
        $this->permission = \Auth::user()->hasAccess('client.all');
    }
    public function index()
    {    if(!$this->permission)
        return redirect()->back()->with('message','No tiene los permisos asignados para acceder')->with('alert','error');

        $tables=Client::all();
        $url='clientes';
        list($referencial, $independiente, $controlador) = $this->sendInfo();
        return view ('local.index',compact('url','tables','referencial','independiente','controlador'));
    }


    public function create()
    {
        if(!$this->permission)
            return redirect()->back()->with('message','No tiene los permisos asignados para acceder')->with('alert','error');

        list($referencial, $independiente, $controlador) = $this->sendInfo();
        $url='clientes';
        $submit='Guardar';
        list($zones, $business) = $this->getCombos();
        $edit=0;
        $cities = City::all()->lists('description', 'id');
        return view ('local.create',compact('cities','edit','url','referencial','independiente','controlador','submit','zones','business'));
    }


    public function store(Requests\CreateLocalRequest $request)
    {
        if(!$this->permission)
            return redirect()->back()->with('message','No tiene los permisos asignados para acceder')->with('alert','error');

        $obj=$request->all();
        $this->cleanStore($obj);
        $obj['zona_id'] = $obj['zone_list'];
        unset($obj['zone_list']);
        $obj['rubro_id'] = $obj['business_list'];
        unset($obj['business_list']);

        Client::create($obj);
        return redirect()->to('/clientes')->with('message','Su local cliente se ha creado con exito')->with('alert','success');
    }



    public function edit($id)
    {
        if(!$this->permission)
            return redirect()->back()->with('message','No tiene los permisos asignados para acceder')->with('alert','error');

        try{
        $submit='Guardar Cambios';
        $model = Client::findOrFail($id);
        list($referencial, $independiente, $controlador) = $this->sendInfo();
        $url='clientes';
        list($zones, $business) = $this->getCombos();
        $edit=0;
        $cities = City::all()->lists('description', 'id');
        $action='ReferentialControllers\ClientController@update';
        return view ('local.edit',compact('zones','action','url','model','submit','cities','edit','referencial','independiente','controlador','business'));
        }catch(\Exception $e){
            return redirect()->back()->with('message','El registro no existe')
                ->with('alert','error');
        }
    }

    public function update($id,Requests\CreateLocalRequest $request)
    {
        if(!$this->permission)
            return redirect()->back()->with('message','No tiene los permisos asignados para acceder')->with('alert','error');

        try{
        $model = Client::findOrFail($id);

        $obj=$request->all();
        $this->cleanStore($obj);
        $obj['zona_id'] = $obj['zone_list'];
        unset($obj['zone_list']);
        $obj['rubro_id'] = $obj['business_list'];
        unset($obj['business_list']);
        $model->update($obj);
        $params = ['message'=>'Se ha guardado con exito',
            'alert'=>'success'];
        return redirect()->to('/clientes')->with($params);
        }catch(\Exception $e){
            return redirect()->back()->with('message','El registro no existe')
                ->with('alert','error');
        }
    }


    public function destroy($id)
    {
        if(!$this->permission)
            return redirect()->back()->with('message','No tiene los permisos asignados para acceder')->with('alert','error');

        Client::destroy($id);
        return redirect()->back()->with('message','El registro se ha eliminado con exito')
            ->with('alert','success');
    }


    public function sendInfo()
    {
        $referencial = 'Clientes';
        $independiente = 'Visita';
        $controlador = '\Client';
        return array($referencial, $independiente, $controlador);
    }


    public function getCombos()
    {

        $zones = Zone::all()->lists('description', 'id');
        $business = Business::all()->lists('description', 'id');
        return array($zones, $business);
    }

    public function cleanStore($obj)
    {
        unset($obj['city_list']);
        unset($obj['kmModal']);
        unset($obj['descriptionModal']);
        unset($obj['comisionModal']);
    }

}
