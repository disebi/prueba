<?php namespace App\Http\Controllers\ReferentialControllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\ReferentialModels\Provider;
use App\Http\Requests\CreateProviderRequest;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class ProviderController extends Controller {


	public function index()
	{
		$providers=Provider::all();
        list($referencial, $independiente) = $this->getInfo();
        return view ('provider.index',compact('providers','referencial','independiente'));
	}


	public function create()
	{
        list($referencial, $independiente) = $this->getInfo();
        return view ('provider.create',compact('referencial','independiente'));
	}


	public function store(CreateProviderRequest $request)
	{
        Provider::create($request->all());
        return redirect()->to('/proveedores')->with('message','Su proveedor se ha creado con exito')->with('alert','success');
	}


	public function edit($id)
	{
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
        try{
            Provider::destroy($id);
            return redirect()->to('/proveedores')->with('message','Su proveedor se ha eliminado con exito')->with('alert','success');
        }

        catch(QueryException $e){

             return redirect()->to('/proveedores')->with('message','Su proveedor no ha podido ser eliminado, ya que se esta utilizando')->with('alert','error');

        }

    }

    /**
     * @return array
     */
    public function getInfo()
    {
        $referencial = 'Proveedor';
        $independiente = "Productos";
        return array($referencial, $independiente);
    }


}
