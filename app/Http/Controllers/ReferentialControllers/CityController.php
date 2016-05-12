<?php namespace App\Http\Controllers\ReferentialControllers;

use App\Models\ReferentialModels\Branch;
use App\Models\ReferentialModels\City;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Log;

class CityController extends Controller {

    public function __construct()
    {
        $this->permission = \Auth::user()->hasAccess('city.all');
    }

	public function index()
	{
        if(!$this->permission)
            return redirect()->back()->with('message','No tiene los permisos asignados para acceder')->with('alert','error');

        $tabla=City::all();
        $url='ciudad';
        list($referencial, $independiente, $controlador) = $this->sendInfo();
        return view ('city.index',compact('url','tabla','referencial','independiente','controlador'));
    }


	public function create()
	{
        if(!$this->permission)
            return redirect()->back()->with('message','No tiene los permisos asignados para acceder')->with('alert','error');

        $url='ciudad';
        $branches=Branch::all()->lists('description','id');
        list($referencial, $independiente, $controlador) = $this->sendInfo();
        $submit='Guardar';
        return view ('city.create',compact('branches','url','referencial','independiente','controlador','submit'));
    }


    public function store(Requests\CreateSimpleReffRequest $request)
    {
        if(!$this->permission)
            return redirect()->back()->with('message','No tiene los permisos asignados para acceder')->with('alert','error');

        $params = ['message'=>'La ciudad se ha guardado con exito',
            'alert'=>'success'];

        $credentials = $this->makeCredentials($request);

        City::create($credentials);
         return \Redirect::to('ciudad')->with($params);
    }


	public function edit($id)
    {
        if(!$this->permission)
            return redirect()->back()->with('message','No tiene los permisos asignados para acceder')->with('alert','error');

        try{
            $submit='Guardar Cambios';
            $model =City::findOrFail($id);
            $url='ciudad';
            $branches=Branch::all()->lists('description','id');
            $action='ReferentialControllers\CityController@update';
            list($referencial, $independiente, $controlador) = $this->sendInfo();
            return view ('city.edit',compact('branches','action','url','model','submit','referencial','independiente'));
        }catch(\Exception $e){
            return redirect()->back()->with('message','El registro no existe')
            ->with('alert','error');
        }
    }


	public function update($id,Requests\CreateSimpleReffRequest $request)
	{
        if(!$this->permission)
            return redirect()->back()->with('message','No tiene los permisos asignados para acceder')->with('alert','error');

        try{
        $model = City::findOrFail($id);
        $input=$request->all();
        $model->description=$input['description'];
        $model->branch_id=$input['branch_list'];
        $model->save();
        $params = ['message'=>'Se ha guardado con exito',
            'alert'=>'success'];
        return \Redirect::to('ciudad')->with($params);
        }catch(\Exception $e){
            return redirect()->back()->with('message','El registro no existe')
                ->with('alert','error');
        }
	}


	public function destroy($id)
	{
        if(!$this->permission)
            return redirect()->back()->with('message','No tiene los permisos asignados para acceder')->with('alert','error');

        try{
            City::destroy($id);
            return redirect()->back()->with('message','El registro se ha eliminado con exito')
                ->with('alert','success');
        }
        catch(QueryException $e){
            return redirect()->to('/ciudad')->with('message','El registro seleccionado no puede ser eliminado, esta siendo utilizado actualmente')
                ->with('alert','error');
        }
	}


    public function sendInfo()
    {
        $referencial = 'Ciudades';
        $independiente = 'Zonas';
        $controlador = '\City';
        return array($referencial, $independiente, $controlador);
    }

    public function makeCredentials(Requests\CreateSimpleReffRequest $request)
    {
        $credentials = ['description' => $request->description,
            'branch_id' => $request->branch_list];

        return $credentials;
    }

}
