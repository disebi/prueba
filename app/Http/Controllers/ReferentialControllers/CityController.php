<?php namespace App\Http\Controllers\ReferentialControllers;

use App\Models\ReferentialModels\City;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class CityController extends Controller {


	public function index()
	{
        $tabla=City::all();
        $url='ciudad';
        list($referencial, $independiente, $controlador) = $this->sendInfo();
        return view ('simpleRef.simple_referential_index',compact('url','tabla','referencial','independiente','controlador'));

    }


	public function create()
	{


        $url='ciudad';
        list($referencial, $independiente, $controlador) = $this->sendInfo();
        $submit='Guardar';
        return view ('simpleRef.simple_referential_create',compact('url','referencial','independiente','controlador','submit'));

    }


    public function store(Requests\CreateSimpleReffRequest $request)
    {


        $input=\Input::all();

        $params = ['message'=>'La ciudad se ha guardado con exito',
            'alert'=>'success'];
        if(array_key_exists('modal',$input)){
            unset($input['modal']);
            $number=City::where('description','=',$input['description'])->count();

            if($number==0){
               City::create($request->all());
                $html=City::select('id','description')->get();
                return $html;

            }else{

                return 0;
            }

        }else{
            City::create($request->all());
            return \Redirect::to('ciudad')->with($params);
        }
    }


	public function edit($id)
	{
        $submit='Guardar Cambios';
        $model =City::find($id);
        $url='ciudad';
        $action='ReferentialControllers\CityController@update';
        list($referencial, $independiente, $controlador) = $this->sendInfo();

        return view ('simpleRef.simple_referential_edit',compact('action','url','model','submit','referencial','independiente'));

    }


	public function update($id,Requests\CreateSimpleReffRequest $request)
	{
        $model = City::find($id);
        $input=$request->all();
        $model->description=$input['description'];
        $model->save();
        $params = ['message'=>'Se ha guardado con exito',
            'alert'=>'success'];
        return \Redirect::to('ciudad')->with($params);

	}


	public function destroy($id)
	{
        try{
            City::destroy($id);
            return redirect()->back()->with('message','El registro se ha eliminado con exito')
                ->with('alert','success');
        }
        catch(QueryException $e){

            return redirect()->to('/ciudad')->with('message','El registro seleccionado no puede ser eliminado, esta siendo utilizado actualmente')
                ->with('alert','error');
        }

	}


    public function sendInfo()
    {
        $referencial = 'Ciudades';
        $independiente = 'Zonas';
        $controlador = '\City';
        return array($referencial, $independiente, $controlador);
    }

    /**
     * @param $input
     */


}
