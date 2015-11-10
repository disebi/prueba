<?php namespace App\Http\Controllers\ReferentialControllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\ReferentialModels\City;
use App\Models\ReferentialModels\Zone;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class ZoneController extends Controller {

    public function index()
    {
        $tables=Zone::all();
        $url='zonas';
        list($referencial, $independiente, $controlador) = $this->sendInfo();
        return view ('zone.index',compact('url','tables','referencial','independiente','controlador'));

    }


    public function create()
    {
        list($referencial, $independiente, $controlador) = $this->sendInfo();
        $url='zonas';
        $submit='Guardar';
        $cities=City::all()->lists('description','id');
        $edit=0;
        return view ('zone.create',compact('edit','url','referencial','independiente','controlador','submit','cities'));

    }


    public function store(Requests\CreateZoneRequest $request)
    {
       $obj=$request->all();
       $obj['city_id'] = $obj['city_list'];
       unset($obj['city_list']);
       Zone::create($obj);
       return redirect()->to('/zonas')->with('message','Su zona se ha creado con exito')->with('alert','success');
    }



    public function edit($id)
    {
        $submit='Guardar Cambios';
        $model = Zone::findOrFail($id);
        $url='zonas';
        $action='ReferentialControllers\ZoneController@update';
        list($referencial, $independiente, $controlador) = $this->sendInfo();
        $cities=City::all()->lists('description','id');
        return view ('zone.edit',compact('cities','action','url','model','submit','referencial','independiente'));

    }


    public function update($id,Requests\CreateZoneRequest $request)
    {
        $model = Zone::find($id);
        $obj=$request->all();
        $obj['city_id'] = $obj['city_list'];
        unset($obj['city_list']);
        $model->update($obj);
        $params = ['message'=>'Se ha guardado con exito',
            'alert'=>'success'];
        return redirect()->to('/zonas')->with($params);
    }

    public function destroy($id)
    {
        try{
        Zone::destroy($id);
        return redirect()->back()->with('message', 'El registro se ha eliminado con exito')
            ->with('alert', 'success');
    }catch(QueryException $e){
            return redirect()->back()->with('message', 'El registro no ha podido ser eliminado, esta siendo utilizado actualmente')
                ->with('alert', 'error');
        }
    }

    public function sendInfo()
    {
        $referencial = 'Zonas';
        $independiente = 'Locales';
        $controlador = '\Zone';
        return array($referencial, $independiente, $controlador);
    }

    public function storeModal(Requests\CreateZoneRequest $request)
    {
        $input=$request->all();
        unset($input['_token']);
        $input['city_id'] = $input['city_list'];
        unset($input['city_list']);
        Zone::create($input);
        $html=Zone::select('id','description')->get();
        return $html;
    }
}
