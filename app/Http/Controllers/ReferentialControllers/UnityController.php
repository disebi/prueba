<?php namespace App\Http\Controllers\ReferentialControllers;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\ReferentialModels\Unity;
use Illuminate\Http\Request;

class UnityController extends Controller {

    public function __construct()
    {
        $this->permission = \Auth::user()->hasAccess('unity.all');
    }

	public function index()
	{
        if(!$this->permission)
            return redirect()->back()->with('message','No tiene los permisos asignados para acceder')->with('alert','error');

        $tabla=Unity::all();
        $url='unidades';
        list($referencial, $independiente, $controlador) = $this->sendInfo();
        return view ('simpleRef.simple_referential_index',compact('url','tabla','referencial','independiente','controlador'));

    }


	public function create()
	{
        if(!$this->permission)
            return redirect()->back()->with('message','No tiene los permisos asignados para acceder')->with('alert','error');

        list($referencial, $independiente, $controlador) = $this->sendInfo();
        $url='unidades';
        $submit='Guardar';
        return view ('simpleRef.simple_referential_create',compact('url','referencial','independiente','controlador','submit'));

    }


    public function store(Requests\CreateSimpleReffRequest $request)
    {
        if(!$this->permission)
            return redirect()->back()->with('message','No tiene los permisos asignados para acceder')->with('alert','error');

        $row = $request->input('description');
        $rowcount = Unity::where('description', '=', $row)->get()->toArray();

        if (Empty($rowcount)) {

            Unity::create($request->all());
            $params = ['message' => 'Se ha guardado con exito',
                'alert' => 'success'];
            return redirect()->to('unidades')->with($params);
        } else {
            return redirect()->back()->with('message', 'El registro ya existe')
                ->with('alert', 'error');
        } }



	public function edit($id)
	{
        if(!$this->permission)
            return redirect()->back()->with('message','No tiene los permisos asignados para acceder')->with('alert','error');

        try{
        $submit='Guardar Cambios';
        $model = Unity::findOrFail($id);
        $url='unidades';
        $action='ReferentialControllers\UnityController@update';
        list($referencial, $independiente, $controlador) = $this->sendInfo();
        return view ('simpleRef.simple_referential_edit',compact('action','url','model','submit','referencial','independiente'));
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
        $model = Unity::findOrFail($id);
        $input=$request->all();
        $model->description=$input['description'];
        $model->save();
        $params = ['message'=>'Se ha guardado con exito',
            'alert'=>'success'];
        return redirect()->to('unidades')->with($params);
        }catch(\Exception $e){
            return redirect()->back()->with('message','El registro no existe')
                ->with('alert','error');
        }
    }


	public function destroy($id)
	{
        if(!$this->permission)
            return redirect()->back()->with('message','No tiene los permisos asignados para acceder')->with('alert','error');

        Unity::destroy($id);
        return redirect()->back()->with('message','El registro se ha eliminado con exito')
            ->with('alert','success');
	}


    public function sendInfo()
    {
        $referencial = 'Unidades';
        $independiente = 'Productos';
        $controlador = '\Unity';
        return array($referencial, $independiente, $controlador);
    }
}
