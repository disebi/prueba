<?php namespace App\Http\Controllers\ReferentialControllers;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\ReferentialModels\Tax;
use Illuminate\Http\Request;
use Redirect;

class TaxController extends Controller {

    public function __construct()
    {
        $this->permission = \Auth::user()->hasAccess('tax.all');
    }

    public function index()
    {
        if(!$this->permission)
            return redirect()->back()->with('message','No tiene los permisos asignados para acceder')->with('alert','error');

        $url='impuestos';
        $tabla=Tax::orderBy('id','desc')->get();
        list($referencial, $independiente, $controlador) = $this->sendInfo();
        return view ('taxes.index',compact('url','tabla','referencial','independiente','controlador'));
    }


    public function create()
    {
        if(!$this->permission)
            return redirect()->back()->with('message','No tiene los permisos asignados para acceder')->with('alert','error');

        $url='impuestos';
        list($referencial, $independiente, $controlador) = $this->sendInfo();
        $submit='Guardar';
        return view ('taxes.create',compact('url','referencial','independiente','controlador','submit'));
    }


    public function store(Requests\CreateTaxesRequest $request)
    {
        if(!$this->permission)
            return redirect()->back()->with('message','No tiene los permisos asignados para acceder')->with('alert','error');

        Tax::create($request->all());
        $params = ['message'=>'Se ha guardado con exito',
            'alert'=>'success'];
        return Redirect::to('impuestos')->with($params);
    }


    public function edit($id)
    {
        if(!$this->permission)
            return redirect()->back()->with('message','No tiene los permisos asignados para acceder')->with('alert','error');

        try{
        $submit='Guardar Cambios';
        $model = Tax::findOrFail($id);
        $url='impuestos';
        $action='ReferentialControllers\TaxController@update';
        list($referencial, $independiente, $controlador) = $this->sendInfo();
        return view ('taxes.edit',compact('action','url','model','submit','referencial','independiente'));
        }catch(\Exception $e){
            return redirect()->back()->with('message','El registro no existe')
                ->with('alert','error');
        }
    }


    public function update($id, Requests\CreateTaxesRequest $request)
    {
        if(!$this->permission)
            return redirect()->back()->with('message','No tiene los permisos asignados para acceder')->with('alert','error');

        try{
        $model = Tax::findOrFail($id);
        $input=$request->all();
        $model->description=$input['description'];
        $model->valor=$input['valor'];
        $model->save();
        $params = ['message'=>'Se ha guardado con exito',
            'alert'=>'success'];
        return \Redirect::to('impuestos')->with($params);
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
            Tax::destroy($id);
            return redirect()->back()->with('message','El registro se ha eliminado con exito')
                ->with('alert','success');

        }catch(QueryException $e){
            return redirect()->to('/impuestos')->with('message','Su registro no ha podido ser eliminado, ya que se esta utilizando')->with('alert','error');
        }
    }


    public function sendInfo()
    {
        if(!$this->permission)
            return redirect()->back()->with('message','No tiene los permisos asignados para acceder')->with('alert','error');

        $referencial = 'Impuestos';
        $independiente = 'Productos';
        $controlador = '\Tax';
        return array($referencial, $independiente, $controlador);
    }


}
