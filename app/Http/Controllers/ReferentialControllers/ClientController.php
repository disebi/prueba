<?php namespace App\Http\Controllers\ReferentialControllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\ReferentialModels\Business;
use App\Models\ReferentialModels\City;
use App\Models\ReferentialModels\Client;
use App\Models\ReferentialModels\Zone;
use Illuminate\Http\Request;

class ClientController extends Controller {


    public function index()
    {


        $tables=Client::all();



        $url='clientes';
        list($referencial, $independiente, $controlador) = $this->sendInfo();
        return view ('local.index',compact('url','tables','referencial','independiente','controlador'));

    }


    public function create()
    {
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
        $obj=$request->all();

        $obj['zona_id'] = $obj['zone_list'];
        unset($obj['zone_list']);
        $obj['rubro_id'] = $obj['business_list'];
        unset($obj['business_list']);

        Client::create($obj);

        return redirect()->to('/clientes')->with('message','Su local cliente se ha creado con exito')->with('alert','success');



    }



    public function edit($id)
    {
        $submit='Guardar Cambios';
        $model = Client::findOrFail($id);


        $url='Clients';
        $action='ReferentialControllers\ClientController@update';
        list($referencial, $independiente, $controlador) = $this->sendInfo();

        list($zones, $business) = $this->getCombos();

        return view ('local.edit',compact('business','zones','action','url','model','submit','referencial','independiente'));

    }


    public function update($id,Requests\CreateLocalRequest $request)
    {
        $model = Client::find($id);

        $obj=$request->all();
        $obj['zona_id'] = $obj['zone_list'];
        unset($obj['zone_list']);
        $obj['rubro_id'] = $obj['business_list'];
        unset($obj['business_list']);
        $model->update($obj);
        $params = ['message'=>'Se ha guardado con exito',
            'alert'=>'success'];
        return redirect()->to('/clientes')->with($params);

    }


    public function destroy($id)
    {
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

    /**
     * @return array
     */
    public function getCombos()
    {
        $zones = Zone::all()->lists('description', 'id');
        $business = Business::all()->lists('description', 'id');
        return array($zones, $business);
    }

}
