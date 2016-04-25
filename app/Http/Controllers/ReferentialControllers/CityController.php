<?php namespace App\Http\Controllers\ReferentialControllers;

use App\Models\ReferentialModels\Branch;
use App\Models\ReferentialModels\City;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Log;

class CityController extends Controller {


	public function index()
	{
        $tabla=City::all();
        $url='ciudad';
        list($referencial, $independiente, $controlador) = $this->sendInfo();
        return view ('city.index',compact('url','tabla','referencial','independiente','controlador'));
    }


	public function create()
	{

        $url='ciudad';
        $branches=Branch::all()->lists('description','id');
        list($referencial, $independiente, $controlador) = $this->sendInfo();
        $submit='Guardar';
        return view ('city.create',compact('branches','url','referencial','independiente','controlador','submit'));
    }


    public function store(Requests\CreateSimpleReffRequest $request)
    {

        $params = ['message'=>'La ciudad se ha guardado con exito',
            'alert'=>'success'];

        $credentials = $this->makeCredentials($request);

        City::create($credentials);
         return \Redirect::to('ciudad')->with($params);
    }


	public function edit($id)
    {
        try{
            $submit='Guardar Cambios';
            $model =City::findOrFail($id);
            $url='ciudad';
            $branches=Branch::all()->lists('description','id');
            $action='ReferentialControllers\CityController@update';
            list($referencial, $independiente, $controlador) = $this->sendInfo();
            return view ('city.edit',compact('branches','action','url','model','submit','referencial','independiente'));
        }catch(\Exception $e){
            return redirect()->back()->with('message','El registro no existe')
            ->with('alert','error');
        }
    }


	public function update($id,Requests\CreateSimpleReffRequest $request)
	{
        try{
        $model = City::findOrFail($id);
        $input=$request->all();
        $model->description=$input['description'];
        $model->branch_id=$input['branch_list'];
        $model->save();
        $params = ['message'=>'Se ha guardado con exito',
            'alert'=>'success'];
        return \Redirect::to('ciudad')->with($params);
        }catch(\Exception $e){
            return redirect()->back()->with('message','El registro no existe')
                ->with('alert','error');
        }
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



    public function storeModal()
    {
        $user=Auth::getUser();
        $input=\Input::all();
        $description=$input['value'];
        $input['description']=$description;
        $input['branch_id']=$user->staff->branch_id;
        unset($input['pk']);
        unset($input['name']);
        unset($input['value']);
        unset($input['_token']);
        $number=City::where('description','=',$input['description'])->count();

        if($number==0){

            City::create($input);
            $html=City::select('id','description')->get();
            return $html;
        }else{
            return 0;
        }
    }


    public function makeCredentials(Requests\CreateSimpleReffRequest $request)
    {
        $credentials = ['description' => $request->description,
            'branch_id' => $request->branch_list];

        return $credentials;
    }

}
