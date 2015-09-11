<?php namespace App\Http\Controllers\ReferentialControllers;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\ReferentialModels\Tax;
use Illuminate\Http\Request;
use Redirect;

class TaxController extends Controller {

    public function index()
    {   $url='impuestos';
        $tabla=Tax::orderBy('id','desc')->get();
        list($referencial, $independiente, $controlador) = $this->sendInfo();
        return view ('taxes.index',compact('url','tabla','referencial','independiente','controlador'));
    }


    public function create()
    {
        $url='impuestos';
        list($referencial, $independiente, $controlador) = $this->sendInfo();
        $submit='Guardar';
        return view ('taxes.create',compact('url','referencial','independiente','controlador','submit'));

    }


    public function store(Requests\CreateTaxesRequest $request)
    {
        Tax::create($request->all());
        $params = ['message'=>'Se ha guardado con exito',
            'alert'=>'success'];
        return Redirect::to('impuestos')->with($params);
    }


    public function edit($id)
    {
        $submit='Guardar Cambios';
        $model = Tax::find($id);
        $url='impuestos';
        $action='ReferentialControllers\TaxController@update';
        list($referencial, $independiente, $controlador) = $this->sendInfo();
        return view ('taxes.edit',compact('action','url','model','submit','referencial','independiente'));

    }


    public function update($id, Requests\CreateTaxesRequest $request)
    {
        $model = Tax::find($id);
        $input=$request->all();
        $model->description=$input['description'];
        $model->valor=$input['valor'];
        $model->save();
        $params = ['message'=>'Se ha guardado con exito',
            'alert'=>'success'];
        return \Redirect::to('impuestos')->with($params);

    }


    public function destroy($id)
    {
        try{
            Tax::destroy($id);
            return redirect()->back()->with('message','El registro se ha eliminado con exito')
                ->with('alert','success');

        }catch(QueryException $e){
            return redirect()->to('/impuestos')->with('message','Su registro no ha podido ser eliminado, ya que se esta utilizando')->with('alert','error');
        }

    }


    public function sendInfo()
    {
        $referencial = 'Impuestos';
        $independiente = 'Productos';
        $controlador = '\Tax';
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
        $number=Tax::where('description','=',$input['description'])->count();

        if($number==0){
            Tax::create($input);
            $html=Tax::select('id','description')->get();
            return $html;
        }else{
            return 0;
        }
    }

}
