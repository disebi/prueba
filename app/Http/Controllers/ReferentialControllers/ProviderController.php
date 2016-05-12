<?php namespace App\Http\Controllers\ReferentialControllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\ReferentialModels\Provider;
use App\Http\Requests\CreateProviderRequest;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class ProviderController extends Controller {
    public function __construct()
    {
        $this->permission = \Auth::user()->hasAccess('provider.all');
    }

	public function index()
	{
        if(!$this->permission)
            return redirect()->back()->with('message','No tiene los permisos asignados para acceder')->with('alert','error');

        $providers=Provider::all();
        list($referencial, $independiente) = $this->getInfo();
        return view ('provider.index',compact('providers','referencial','independiente'));
	}


	public function create()
	{
        if(!$this->permission)
            return redirect()->back()->with('message','No tiene los permisos asignados para acceder')->with('alert','error');

        list($referencial, $independiente) = $this->getInfo();
        return view ('provider.create',compact('referencial','independiente'));
	}


	public function store(CreateProviderRequest $request)
	{
        if(!$this->permission)
            return redirect()->back()->with('message','No tiene los permisos asignados para acceder')->with('alert','error');

        Provider::create($request->all());
        return redirect()->to('/proveedores')->with('message','Su proveedor se ha creado con exito')->with('alert','success');
	}


	public function edit($id)
	{
        if(!$this->permission)
            return redirect()->back()->with('message','No tiene los permisos asignados para acceder')->with('alert','error');

        try{
        $submit='Guardar Cambios';
        $model =Provider::findOrFail($id);
        list($referencial, $independiente) = $this->getInfo();
        $url='proveedores';
        $action='ReferentialControllers\ProviderController@update';
        return view ('provider.edit',compact('action','url','model','submit','referencial','independiente'));
        }catch(\Exception $e){
            return redirect()->back()->with('message','El registro no existe')
                ->with('alert','error');
        }
    }


	public function update(CreateProviderRequest $request, $id)
	{
        if(!$this->permission)
            return redirect()->back()->with('message','No tiene los permisos asignados para acceder')->with('alert','error');

        try{
        $input=$request->all();
        $provider=Provider::findorFail($id);
        $provider->update($input);
        return redirect()->to('/proveedores')->with('message','Su proveedor se ha actualizado con exito')->with('alert','success');
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
            Provider::destroy($id);
            return redirect()->to('/proveedores')->with('message','Su proveedor se ha eliminado con exito')->with('alert','success');
        }

        catch(QueryException $e){

             return redirect()->to('/proveedores')->with('message','Su proveedor no ha podido ser eliminado, ya que se esta utilizando')->with('alert','error');
        }
    }

    public function getInfo()
    {
        $referencial = 'Proveedor';
        $independiente = "Productos";
        return array($referencial, $independiente);
    }


}
