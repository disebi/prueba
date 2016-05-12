<?php namespace App\Http\Controllers\ReferentialControllers;

use App\Http\Requests;
use App\Models\ReferentialModels\Aroma;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;

class AromaController extends Controller {

    public function __construct()
    {
      $this->permission = \Auth::user()->hasAccess('aroma.all');
    }

    public function index()
	{
        if(!$this->permission)
          return redirect()->back()->with('message','No tiene los permisos asignados para acceder')->with('alert','error');

        $tabla=Aroma::all();
        list($referencial, $independiente, $controlador) = $this->sendInfo();
        $url = 'aromas';
        return view ('simpleRef.simple_referential_index',compact('url','tabla','referencial','independiente','controlador'));
    }

	public function create()
	{
        if(!$this->permission)
            return redirect()->back()->with('message','No tiene los permisos asignados para acceder')->with('alert','error');

        list($referencial, $independiente, $controlador) = $this->sendInfo();
        $submit='Guardar';
        $url = 'aromas';
        return view ('simpleRef.simple_referential_create',compact('url','referencial','independiente','controlador','submit'));
    }

	public function store(Requests\CreateSimpleReffRequest $request)
	{
        if(!$this->permission)
            return redirect()->back()->with('message','No tiene los permisos asignados para acceder')->with('alert','error');

        $row=$request->input('description');
        $rowcount= Aroma::where('description','=',$row)->get()->toArray();
        if ( Empty($rowcount)){
            Aroma::create($request->all());
            $params = ['message'=>'Se ha guardado con exito',
                'alert'=>'success'];
            return Redirect::to('aromas')->with($params);
        }else{
            return redirect()->back()->with('message','El registro ya existe')
                ->with('alert','error');
        }
    }

	public function edit($id)
	{
        if(!$this->permission)
            return redirect()->back()->with('message','No tiene los permisos asignados para acceder')->with('alert','error');

        try{
            $submit='Guardar Cambios';
            $model = Aroma::findOrFail($id);
            $url='aromas';
            $action='ReferentialControllers\AromaController@update';
            list($referencial, $independiente, $controlador) = $this->sendInfo();
            return view ('simpleRef.simple_referential_edit',compact('action','url','model','submit','referencial','independiente'));
        }catch(\Exception $e){
            return redirect()->back()->with('message','El registro no existe')
                ->with('alert','error');
        }

	}


	public function update($id, Requests\CreateSimpleReffRequest $request)
	{
        if(!$this->permission)
            return redirect()->back()->with('message','No tiene los permisos asignados para acceder')->with('alert','error');

        try{
        $model = Aroma::findOrFail($id);
        $input=$request->all();
        $model->description=$input['description'];
        $model->save();
        $params = ['message'=>'Se ha guardado con exito',
            'alert'=>'success'];
        return \Redirect::to('aromas')->with($params);

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
		Aroma::destroy($id);
        return redirect()->back()->with('message','El registro se ha eliminado con exito')
        ->with('alert','success');
            }
        catch(QueryException $e){
        return redirect()->to('/aromas')->with('message','Su registro no ha podido ser eliminado, ya que se esta utilizando')->with('alert','error');
        }
	}

    public function sendInfo()
    {
        $referencial = 'Aroma';
        $independiente = 'Productos';
        $controlador = '\Aroma';
        return array($referencial, $independiente, $controlador);
    }

}
