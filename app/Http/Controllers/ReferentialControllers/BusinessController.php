<?php namespace App\Http\Controllers\ReferentialControllers;
use App\Models\ReferentialModels\Brand;
use App\Models\ReferentialModels\Business;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class BusinessController extends Controller {


	public function index()
	{
        $tabla=Business::all();
        $url='rubros';
        list($referencial, $independiente, $controlador) = $this->sendInfo();
        return view ('simpleRef.simple_referential_index',compact('url','tabla','referencial','independiente','controlador'));
    }


	public function create()
	{
        list($referencial, $independiente, $controlador) = $this->sendInfo();
        $submit='Guardar';
        $url='rubros';
        return view ('simpleRef.simple_referential_create',compact('url','referencial','independiente','controlador','submit'));
    }


    public function store(Requests\CreateSimpleReffRequest $request)
    {
        Business::create($request->all());
        return (BusinessController::index());
    }



	public function edit($id)
	{
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
