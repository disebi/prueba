<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\License;
use Illuminate\Http\Request;

class LicenseController extends Controller {

    public function index()
    {
        $url='permisos';
        $tabla=License::all();
        list($referencial, $independiente, $controlador) = $this->sendInfo();
        return view ('license.index',compact('url','tabla','referencial','independiente','controlador'));
    }

    public function create()
    {
        list($referencial, $independiente, $controlador) = $this->sendInfo();
        $submit='Guardar';
        $partials=[0=>'.all',1=>'.view',2=>'.mod',3=>'.del',4=>'.rep'];
        $url='permisos';
         $array=0;
        return view ('license.create',compact('array','partials','url','referencial','independiente','controlador','submit'));
    }


    public function store(Requests\CreateLicenseRequest $request)
    {

        $partials=[0=>'.all',1=>'.view',2=>'.mod',3=>'.del',4=>'.rep'];
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
    {   $submit='Guardar Cambios';
        $model = License::find($id);
        $partials=[0=>'.all',1=>'.view',2=>'.mod',3=>'.del',4=>'.rep'];
        $description=$model->description;
        $partial=substr($description,-4);
        $description=substr($description,0,-4);
        $model->description=$description;

        switch ($partial) {
            case '.all':
                $array=0;
                break;
            case '.view':
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
        $model = License::find($id);

        $partials=[0=>'.all',1=>'.view',2=>'.mod',3=>'.del',4=>'.rep'];
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


    public function storeModal()
    {
        $input=\Input::all();
        $description=$input['value'];
        $input['description']=$description;
        unset($input['pk']);
        unset($input['name']);
        unset($input['value']);
        unset($input['_token']);
        $number=License::where('description','=',$input['description'])->count();

        if($number==0){
            License::create($input);
            $html=License::select('id','description')->get();
            return $html;
        }else{
            return 0;
        }
    }


}
