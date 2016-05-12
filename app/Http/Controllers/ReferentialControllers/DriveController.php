<?php namespace App\Http\Controllers\ReferentialControllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\ReferentialModels\Brand;
use App\Models\ReferentialModels\Drive;
use Illuminate\Http\Request;

class DriveController extends Controller {

    public function __construct()
    {
        $this->permission = \Auth::user()->hasAccess('drive.all');
    }

    public function index()
    {
        if(!$this->permission)
            return redirect()->back()->with('message','No tiene los permisos asignados para acceder')->with('alert','error');

        $drives=Drive::all();
        $url='vehiculos';
        list($referencial, $independiente, $controlador) = $this->sendInfo();
        return view ('drive.index',compact('url','drives','referencial','independiente','controlador'));
    }


    public function create()
    {   if(!$this->permission)
        return redirect()->back()->with('message','No tiene los permisos asignados para acceder')->with('alert','error');

        list($referencial, $independiente, $controlador) = $this->sendInfo();
        $url='vehiculos';
        $submit='Guardar';
        $brands=Brand::all()->lists('description','id');
        $edit=0;
        return view ('drive.create',compact('edit','url','referencial','independiente','controlador','submit','brands'));
    }


    public function store(Requests\CreateDriveRequest $request)
    {
        if(!$this->permission)
            return redirect()->back()->with('message','No tiene los permisos asignados para acceder')->with('alert','error');

        $obj=$request->all();
        $obj['brand_id'] = $obj['brand_list'];
        unset($obj['brand_list']);
        Drive::create($obj);
        return redirect()->to('/vehiculos')->with('message','Su registro se ha creado con exito')->with('alert','success');
    }


    public function edit($id)
    {
        if(!$this->permission)
            return redirect()->back()->with('message','No tiene los permisos asignados para acceder')->with('alert','error');

        try{
        $submit='Guardar Cambios';
        $model = Drive::findOrFail($id);
        $url='vehiculos';
        $action='ReferentialControllers\DriveController@update';
        list($referencial, $independiente, $controlador) = $this->sendInfo();
        $brands=Brand::all()->lists('description','id');
        return view ('drive.edit',compact('brands','action','url','model','submit','referencial','independiente'));
        }catch(\Exception $e){
            return redirect()->back()->with('message','El registro no existe')
                ->with('alert','error');
        }
    }

    public function update($id,Requests\CreateDriveRequest $request)
    {
        if(!$this->permission)
            return redirect()->back()->with('message','No tiene los permisos asignados para acceder')->with('alert','error');

        try{
        $model = Drive::findOrFail($id);
        $obj=$request->all();
        $obj['brand_id'] = $obj['brand_list'];
        unset($obj['brand_list']);
        $model->update($obj);
        $params = ['message'=>'Se ha guardado con exito',
            'alert'=>'success'];
        return redirect()->to('/vehiculos')->with($params);
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
            Drive::destroy($id);
            return redirect()->back()->with('message', 'El registro se ha eliminado con exito')
                ->with('alert', 'success');
        }catch(QueryException $e){
            return redirect()->back()->with('message', 'El registro no ha podido ser eliminado, esta siendo utilizado actualmente')
                ->with('alert', 'error');
        }
    }


    public function sendInfo()
    {
        $referencial = 'Vehiculos';
        $independiente = 'Empresa';
        $controlador = '\Drive';
        return array($referencial, $independiente, $controlador);
    }

}
