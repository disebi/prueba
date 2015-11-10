<?php namespace App\Http\Controllers\ReferentialControllers;

use App\Models\ReferentialModels\Brand;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class BrandController extends Controller {


	public function index()
	{
        $url='marcas';
        $tabla=Brand::all();
        list($referencial, $independiente, $controlador) = $this->sendInfo();
        return view ('simpleRef.simple_referential_index',compact('url','tabla','referencial','independiente','controlador'));

    }


	public function create()
	{

        list($referencial, $independiente, $controlador) = $this->sendInfo();
        $submit='Guardar';
        $url='marcas';
        return view ('simpleRef.simple_referential_create',compact('url','referencial','independiente','controlador','submit'));

    }


    public function store(Requests\CreateSimpleReffRequest $request)
    {
        $row = $request->input('description');
        $rowcount = Brand::where('description', '=', $row)->get()->toArray();

        if (Empty($rowcount)) {

            Brand::create($request->all());
            $params = ['message' => 'Se ha guardado con exito',
                'alert' => 'success'];
            return redirect()->to('marcas')->with($params);


        } else {


            return redirect()->back()->with('message', 'El registro ya existe')
                ->with('alert', 'error');

        }
    }


	public function edit($id)
	{
        $submit='Guardar Cambios';
        $model = Brand::find($id);


        $url='rubros';
        $action='ReferentialControllers\BrandController@update';
        list($referencial, $independiente, $controlador) = $this->sendInfo();



        return view ('simpleRef.simple_referential_edit',compact('action','url','model','submit','referencial','independiente'));

    }


	public function update($id, Requests\CreateSimpleReffRequest $request)
	{
        $model = Brand::find($id);
        $input=$request->all();
        $model->description=$input['description'];
        $model->save();
        $params = ['message'=>'Se ha guardado con exito',
            'alert'=>'success'];
        return \Redirect::to('marcas')->with($params);


	}


	public function destroy($id)
	{
        try{
        Brand::destroy($id);
        return redirect()->back()->with('message','El registro se ha eliminado con exito')
            ->with('alert','success');

        }catch(QueryException $e){
        return redirect()->to('/marcas')->with('message','Su registro no ha podido ser eliminado, ya que se esta utilizando')->with('alert','error');
        }
	}


    public function sendInfo()
    {
        $referencial = 'Marca';
        $independiente = 'Vehiculo';
        $controlador = '\Brand';
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
        $number=Brand::where('description','=',$input['description'])->count();

        if($number==0){
            Brand::create($input);
            $html=Brand::select('id','description')->get();
            return $html;
        }else{
            return 0;
        }
    }

}
