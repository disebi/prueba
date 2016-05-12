<?php namespace App\Http\Controllers\ReferentialControllers;

use App\Models\ReferentialModels\Brand;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class BrandController extends Controller {

    public function __construct()
    {
        $this->permission = \Auth::user()->hasAccess('brand.all');
    }

	public function index()
	{
        if(!$this->permission)
            return redirect()->back()->with('message','No tiene los permisos asignados para acceder')->with('alert','error');

        $url='marcas';
        $tabla=Brand::all();
        list($referencial, $independiente, $controlador) = $this->sendInfo();
        return view ('simpleRef.simple_referential_index',compact('url','tabla','referencial','independiente','controlador'));

    }


	public function create()
	{
        if(!$this->permission)
            return redirect()->back()->with('message','No tiene los permisos asignados para acceder')->with('alert','error');


        list($referencial, $independiente, $controlador) = $this->sendInfo();
        $submit='Guardar';
        $url='marcas';
        return view ('simpleRef.simple_referential_create',compact('url','referencial','independiente','controlador','submit'));

    }


    public function store(Requests\CreateSimpleReffRequest $request)
    {
        if(!$this->permission)
            return redirect()->back()->with('message','No tiene los permisos asignados para acceder')->with('alert','error');

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
        if(!$this->permission)
            return redirect()->back()->with('message','No tiene los permisos asignados para acceder')->with('alert','error');

        try{
        $submit='Guardar Cambios';
        $model = Brand::findOrFail($id);
        $url='rubros';
        $action='ReferentialControllers\BrandController@update';
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
        $model = Brand::findOrFail($id);
        $input=$request->all();
        $model->description=$input['description'];
        $model->save();
        $params = ['message'=>'Se ha guardado con exito',
            'alert'=>'success'];
        return \Redirect::to('marcas')->with($params);
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


   }
