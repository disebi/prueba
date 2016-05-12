<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\License;
use Illuminate\Http\Request;

class LicenseController extends Controller {

    public function __construct()
    {
        $this->permission = \Auth::user()->hasAccess('license.all');
    }
    public function index()
    {
        if(!$this->permission)
            return redirect()->back()->with('message','No tiene los permisos asignados para acceder')->with('alert','error');

        $url='permisos';
        $tabla=License::all();
        list($referencial, $independiente, $controlador) = $this->sendInfo();
        return view ('license.index',compact('url','tabla','referencial','independiente','controlador'));
    }

    public function create()
    {
        if(!$this->permission)
            return redirect()->back()->with('message','No tiene los permisos asignados para acceder')->with('alert','error');

        list($referencial, $independiente, $controlador) = $this->sendInfo();
        $submit='Guardar';
        $partials = $this->getPartials();
        $url='permisos';
         $array=0;
        return view ('license.create',compact('array','partials','url','referencial','independiente','controlador','submit'));
    }


    public function store(Requests\CreateLicenseRequest $request)
    {
        if(!$this->permission)
            return redirect()->back()->with('message','No tiene los permisos asignados para acceder')->with('alert','error');

        $partials = $this->getPartials();
        $description=$request->input('description');
        $partial=$partials[$request->input('partials')];

        $save=['description'=>$description.$partial,
                'info'=>$request->input('info')];

        License::create($save);
        $params = ['message' => 'Se ha guardado con exito',
                'alert' => 'success'];
        return redirect()->to('permisos')->with($params);

    }


    public function edit($id)
    {
        if(!$this->permission)
            return redirect()->back()->with('message','No tiene los permisos asignados para acceder')->with('alert','error');

        $submit='Guardar Cambios';
        $model = License::find($id);
        $partials = $this->getPartials();
        $description=$model->description;
        $partial=substr($description,-4);
        $description=substr($description,0,-4);
        $model->description=$description;

        switch ($partial) {
            case '.all':
                $array=0;
                break;
            case '.see':
                $array=1;
                break;
            case '.mod':
                $array=2;
                break;
            case '.del':
                $array=3;
                break;
            case '.rep':
                $array=4;
                break;
        }

        $url='permisos';
        $action='LicenseController@update';
        list($referencial, $independiente, $controlador) = $this->sendInfo();

        return view ('license.edit',compact('array','partials','action','url','model','submit','referencial','independiente'));
    }


    public function update($id, Requests\CreateSimpleReffRequest $request)
    {
        if(!$this->permission)
            return redirect()->back()->with('message','No tiene los permisos asignados para acceder')->with('alert','error');

        $model = License::find($id);

        $partials = $this->getPartials();
        $description=$request->input('description');
        $partial=$partials[$request->input('partials')];
        $model->description=$description.$partial;
        $model->info=$request->input('info');
        $model->save();
        $params = ['message'=>'Se ha guardado con exito',
            'alert'=>'success'];
        return \Redirect::to('permisos')->with($params);
    }


    public function destroy($id)
    {
        if(!$this->permission)
            return redirect()->back()->with('message','No tiene los permisos asignados para acceder')->with('alert','error');

        try{
            License::destroy($id);
            return redirect()->back()->with('message','El registro se ha eliminado con exito')
                ->with('alert','success');

        }catch(QueryException $e){
            return redirect()->to('/permisos')->with('message','Su registro no ha podido ser eliminado, ya que se esta utilizando')->with('alert','error');
        }
    }


    public function sendInfo()
    {
        $referencial = 'Permiso';
        $independiente = 'Rol';
        $controlador = 'License';
        return array($referencial, $independiente, $controlador);
    }


    public function getPartials()
    {
        $partials = [0 => '.all', 1 => '.see', 2 => '.mod', 3 => '.del', 4 => '.rep'];
        return $partials;
    }


}
