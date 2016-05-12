<?php namespace App\Http\Controllers\ReferentialControllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;


use App\Http\Requests\StampingRequest;
use App\Models\ReferentialModels\Stamping;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class StampingController extends Controller {

    public function __construct()
    {
        $this->permission = \Auth::user()->hasAccess('stamping.all');
    }

    public function index()
    {
        if(!$this->permission)
            return redirect()->back()->with('message','No tiene los permisos asignados para acceder')->with('alert','error');

        $tabla=Stamping::all();
        $url='timbrados';
        list($referencial, $independiente, $controlador) = $this->sendInfo();
        return view ('stamping.index',compact('url','tabla','referencial','independiente','controlador'));
    }


    public function create()
    {
        if(!$this->permission)
            return redirect()->back()->with('message','No tiene los permisos asignados para acceder')->with('alert','error');

        $url='timbrados';
        list($referencial, $independiente, $controlador) = $this->sendInfo();
        $submit='Guardar';
        return view ('stamping.create',compact('branches','url','referencial','independiente','controlador','submit'));
    }


    public function store(StampingRequest $request)
    {
        if(!$this->permission)
            return redirect()->back()->with('message','No tiene los permisos asignados para acceder')->with('alert','error');

        $params = ['message'=>'La timbrados se ha guardado con exito',
            'alert'=>'success'];

        $model =new Stamping();
        $this->makeCredentials($request,$model);
        return \Redirect::to('timbrados')->with($params);
    }


    public function edit($id)
    {
        if(!$this->permission)
            return redirect()->back()->with('message','No tiene los permisos asignados para acceder')->with('alert','error');

        try{
            $submit='Guardar Cambios';
            $model =Stamping::findOrFail($id);
            $url='timbrados';

            $action='ReferentialControllers\StampingController@update';
            list($referencial, $independiente, $controlador) = $this->sendInfo();
            return view ('stamping.edit',compact('branches','action','url','model','submit','referencial','independiente'));
        }catch(\Exception $e){
            return redirect()->back()->with('message','El registro no existe')
                ->with('alert','error');
        }
    }


    public function update($id,StampingRequest $request)
    {
        if(!$this->permission)
            return redirect()->back()->with('message','No tiene los permisos asignados para acceder')->with('alert','error');

        try{
           $this->makeCredentials($request,Stamping::findOrFail($id));
            $params = ['message'=> 'Se ha guardado con exito',
                        'alert' => 'success'];
            return \Redirect::to('timbrados')->with($params);
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
            Stamping::destroy($id);
            return redirect()->back()->with('message','El registro se ha eliminado con exito')
                ->with('alert','success');
        }
        catch(QueryException $e){
            return redirect()->to('/timbrados')->with('message','El registro seleccionado no puede ser eliminado, esta siendo utilizado actualmente')
                ->with('alert','error');
        }
    }


    public function sendInfo()
    {
        $referencial = 'Timbrados';
        $independiente = 'Facturas';
        $controlador = '\Stamping';
        return array($referencial, $independiente, $controlador);
    }


    public function makeCredentials(StampingRequest $request, $model)
    {
        $model->do =  $request->do;
        $model->from =  $request->from;
        $model->to =  $request->to;
        $model->save();
    }

}
