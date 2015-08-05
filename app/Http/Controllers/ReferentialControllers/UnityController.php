<?php namespace App\Http\Controllers\ReferentialControllers;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\ReferentialModels\Unity;
use Illuminate\Http\Request;

class UnityController extends Controller {

	public function index()
	{
        $tabla=Unity::all();
        $url='unidades';
        list($referencial, $independiente, $controlador) = $this->sendInfo();
        return view ('simpleRef.simple_referential_index',compact('url','tabla','referencial','independiente','controlador'));

    }


	public function create()
	{
        list($referencial, $independiente, $controlador) = $this->sendInfo();
        $url='unidades';
        $submit='Guardar';
        return view ('simpleRef.simple_referential_create',compact('url','referencial','independiente','controlador','submit'));

    }


    public function store(Requests\CreateSimpleReffRequest $request)
    {
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
        $submit='Guardar Cambios';
        $model = Unity::find($id);


        $url='unidades';
        $action='ReferentialControllers\UnityController@update';
        list($referencial, $independiente, $controlador) = $this->sendInfo();



        return view ('simpleRef.simple_referential_edit',compact('action','url','model','submit','referencial','independiente'));

    }


	public function update($id,Requests\CreateSimpleReffRequest $request)
	{
        $model = Unity::find($id);
        $input=$request->all();
        $model->description=$input['description'];
        $model->save();
        $params = ['message'=>'Se ha guardado con exito',
            'alert'=>'success'];
        return redirect()->to('unidades')->with($params);

    }


	public function destroy($id)
	{
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
