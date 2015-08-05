<?php namespace App\Http\Controllers\ReferentialControllers;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\ReferentialModels\Presentation;
use Illuminate\Http\Request;

class PresentationController extends Controller {


	public function index()
	{
        $url='presentaciones';
        $tabla=Presentation::all();
        list($referencial, $independiente, $controlador) = $this->sendInfo();
        return view ('simpleRef.simple_referential_index',compact('url','tabla','referencial','independiente','controlador'));

    }


	public function create()
	{
        $url='presentaciones';
        list($referencial, $independiente, $controlador) = $this->sendInfo();

        $submit='Guardar';
        return view ('simpleRef.simple_referential_create',compact('url','referencial','independiente','controlador','submit'));

    }


    public function store(Requests\CreateSimpleReffRequest $request)
    {
        Presentation::create($request->all());

        return (PresentationController::index());
    }


	public function edit($id)
	{
        $submit='Guardar Cambios';
        $model = Presentation::find($id);


        $url='presentaciones';
        $action='ReferentialControllers\PresentationController@update';
        list($referencial, $independiente, $controlador) = $this->sendInfo();



        return view ('simpleRef.simple_referential_edit',compact('action','url','model','submit','referencial','independiente'));

    }


	public function update($id,Requests\CreateSimpleReffRequest $request)
	{
        $model = Presentation::find($id);
        $input=$request->all();
        $model->description=$input['description'];
        $model->save();
        $params = ['message'=>'Se ha guardado con exito',
            'alert'=>'success'];
        return redirect()->to('presentaciones')->with($params);

	}


	public function destroy($id)
	{
        Presentation::destroy($id);
        return redirect()->back()->with('message','El registro se ha eliminado con exito')
            ->with('alert','success');
	}


    public function sendInfo()
    {
        $referencial = 'Presentacion';
        $independiente = 'Productos';
        $controlador = '\Presentation';
        return array($referencial, $independiente, $controlador);
    }

}
