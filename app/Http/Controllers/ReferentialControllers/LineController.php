<?php namespace App\Http\Controllers\ReferentialControllers;
use Illuminate\Database\Eloquent\Model;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use App\Models\ReferentialModels\Line;
use Illuminate\Http\Request;
use App\Actions;

class LineController extends Controller {

    public function __construct()
    {
        $this->permission = \Auth::user()->hasAccess('line.all');
    }

	public function index()

	{
        if(!$this->permission)
            return redirect()->back()->with('message','No tiene los permisos asignados para acceder')->with('alert','error');

        $url='lineas';
        $tabla=Line::orderBy('id','desc')->get();
        list($referencial, $independiente, $controlador) = $this->sendInfo();
        return view ('simpleRef.simple_referential_index',compact('url','tabla','referencial','independiente','controlador'));
    }


	public function create()
	{
        if(!$this->permission)
            return redirect()->back()->with('message','No tiene los permisos asignados para acceder')->with('alert','error');
        $url = 'lineas';
            list($referencial, $independiente, $controlador) = $this->sendInfo();
            $submit = 'Guardar';
            return view('simpleRef.simple_referential_create', compact('url', 'referencial', 'independiente', 'controlador', 'submit'));

	}


    public function store(Requests\CreateSimpleReffRequest $request)
    {
        if(!$this->permission)
            return redirect()->back()->with('message','No tiene los permisos asignados para acceder')->with('alert','error');
        $row=$request->input('description');
        $rowcount= Line::where('description','=',$row)->get()->toArray();
        if ( Empty($rowcount)){
            Line::create($request->all());
            $params = ['message'=>'Se ha guardado con exito',
                'alert'=>'success'];
            return Redirect::to('lineas')->with($params);
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
         $model = Line::findOrFail($id);
         $url='aromas';
         $action='ReferentialControllers\LineController@update';
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
        $model = Line::findOrFail($id);
        $input=$request->all();
        $model->description=$input['description'];
        $model->save();
        $params = ['message'=>'Se ha guardado con exito',
            'alert'=>'success'];
        return \Redirect::to('lineas')->with($params);
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
       Line::destroy($id);
        return redirect()->back()->with('message','El registro se ha eliminado con exito')
            ->with('alert','success');

         }catch(QueryException $e){
        return redirect()->to('/lineas')->with('message','Su registro no ha podido ser eliminado, ya que se esta utilizando')->with('alert','error');
}

	}

    public function sendInfo()
    {
        $referencial = 'Linea';
        $independiente = 'Productos';
        $controlador = '\Line';
        return array($referencial, $independiente, $controlador);
    }

}
