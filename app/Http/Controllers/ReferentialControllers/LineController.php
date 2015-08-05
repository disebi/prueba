<?php namespace App\Http\Controllers\ReferentialControllers;
use Illuminate\Database\Eloquent\Model;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use App\Models\ReferentialModels\Line;
use Illuminate\Http\Request;

class LineController extends Controller {


	public function index()
	{   $url='lineas';
        $tabla=Line::orderBy('id','desc')->get();
        list($referencial, $independiente, $controlador) = $this->sendInfo();
        return view ('simpleRef.simple_referential_index',compact('url','tabla','referencial','independiente','controlador'));
	}


	public function create()
	{
        $url='lineas';
        list($referencial, $independiente, $controlador) = $this->sendInfo();
        $submit='Guardar';
        return view ('simpleRef.simple_referential_create',compact('url','referencial','independiente','controlador','submit'));

	}


    public function store(Requests\CreateSimpleReffRequest $request)
    {

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
        $submit='Guardar Cambios';
        $model = Line::find($id);


        $url='aromas';
        $action='ReferentialControllers\LineController@update';
        list($referencial, $independiente, $controlador) = $this->sendInfo();



        return view ('simpleRef.simple_referential_edit',compact('action','url','model','submit','referencial','independiente'));

    }


	public function update($id, Requests\CreateSimpleReffRequest $request)
	{
        $model = Line::find($id);
        $input=$request->all();
        $model->description=$input['description'];
        $model->save();
        $params = ['message'=>'Se ha guardado con exito',
            'alert'=>'success'];
        return \Redirect::to('lineas')->with($params);

	}


	public function destroy($id)
	{
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
