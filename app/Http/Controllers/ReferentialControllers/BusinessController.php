<?php namespace App\Http\Controllers\ReferentialControllers;
use App\Models\ReferentialModels\Brand;
use App\Models\ReferentialModels\Business;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class BusinessController extends Controller {

    public function __construct()
    {
        $this->permission = \Auth::user()->hasAccess('business.all');
    }
	public function index()
	{
        if(!$this->permission)
        return redirect()->back()->with('message','No tiene los permisos asignados para acceder')->with('alert','error');

        $tabla=Business::all();
        $url='rubros';
        list($referencial, $independiente, $controlador) = $this->sendInfo();
        return view ('simpleRef.simple_referential_index',compact('url','tabla','referencial','independiente','controlador'));
    }


	public function create()
	{
        if(!$this->permission)
            return redirect()->back()->with('message','No tiene los permisos asignados para acceder')->with('alert','error');

        list($referencial, $independiente, $controlador) = $this->sendInfo();
        $submit='Guardar';
        $url='rubros';
        return view ('simpleRef.simple_referential_create',compact('url','referencial','independiente','controlador','submit'));
    }


    public function store(Requests\CreateSimpleReffRequest $request)
    {
        if(!$this->permission)
            return redirect()->back()->with('message','No tiene los permisos asignados para acceder')->with('alert','error');

        Business::create($request->all());
        return (BusinessController::index());
    }



	public function edit($id)
	{
        if(!$this->permission)
            return redirect()->back()->with('message','No tiene los permisos asignados para acceder')->with('alert','error');

        try{
        $submit='Guardar Cambios';
        $model = Business::findOrFail($id);
        $url='rubros';
        $action='ReferentialControllers\BusinessController@update';
        list($referencial, $independiente, $controlador) = $this->sendInfo();
        return view ('simpleRef.simple_referential_edit',compact('action','url','model','submit','referencial','independiente'));
       }catch(\Exception $e){
           return redirect()->back()->with('message','El registro no existe')
               ->with('alert','error');
       }
    }


	public function update ($id, Requests\CreateSimpleReffRequest $request) {
        if(!$this->permission)
            return redirect()->back()->with('message','No tiene los permisos asignados para acceder')->with('alert','error');

        try{
            $model = Business::findOrFail($id);
            $input=$request->all();
            $model->description=$input['description'];
            $model->save();
            $params = ['message'=>'Se ha guardado con exito',
                'alert'=>'success'];
            return \Redirect::to('rubros')->with($params);
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
        Business::destroy($id);
        return redirect()->back()->with('message','El registro se ha eliminado con exito')
            ->with('alert','success');

        }catch(QueryException $e){
        return redirect()->to('/rubros')->with('message','Su registro no ha podido ser eliminado, ya que se esta utilizando')->with('alert','error');
        }

	}


    public function sendInfo()
    {
        $referencial = 'Rubro';
        $independiente = 'Locales';
        $controlador = '\Business';
        return array($referencial, $independiente, $controlador);
    }


}
