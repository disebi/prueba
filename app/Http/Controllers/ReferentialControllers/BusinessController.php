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
        $submit='Guardar Cambios';
        $model = Business::find($id);
        $url='rubros';
        $action='ReferentialControllers\BusinessController@update';
        list($referencial, $independiente, $controlador) = $this->sendInfo();
        return view ('simpleRef.simple_referential_edit',compact('action','url','model','submit','referencial','independiente'));

    }


	public function update ($id, Requests\CreateSimpleReffRequest $request) {
        $model = Business::find($id);
        $input=$request->all();
        $model->description=$input['description'];
        $model->save();
        $params = ['message'=>'Se ha guardado con exito',
            'alert'=>'success'];
        return \Redirect::to('rubros')->with($params);
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

    public function storeModal()
    {
        $input=\Input::all();
        $description=$input['value'];
        $input['description']=$description;
        unset($input['pk']);
        unset($input['name']);
        unset($input['value']);
        unset($input['_token']);
        $number=Business::where('description','=',$input['description'])->count();

        if($number==0){
            Business::create($input);
            $html=Business::select('id','description')->get();
            return $html;
        }else{
            return 0;
        }
    }

}
