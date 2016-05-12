<?php namespace App\Http\Controllers\ReferentialControllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\ReferentialModels\Branch;
use App\Models\ReferentialModels\Deposit;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class DepositController extends Controller {

    public function __construct()
    {
        $this->permission = \Auth::user()->hasAccess('deposit.all');
    }
	public function index()
	{
        if(!$this->permission)
            return redirect()->back()->with('message','No tiene los permisos asignados para acceder')->with('alert','error');

        $tables=Deposit::all();
        $url='depositos';
        list($referencial, $independiente, $controlador) = $this->sendInfo();
        return view ('deposit.index',compact('url','tables','referencial','independiente','controlador'));

    }


	public function create()
	{
        if(!$this->permission)
            return redirect()->back()->with('message','No tiene los permisos asignados para acceder')->with('alert','error');

        list($referencial, $independiente, $controlador) = $this->sendInfo();
        $url='depositos';
        $submit='Guardar';
        $branches=Branch::all()->lists('description','id');
        $edit=0;
        return view ('deposit.create',compact('edit','url','referencial','independiente','controlador','submit','branches'));

    }


    public function store(Requests\CreateDepositRequest $request)
    {
        if(!$this->permission)
            return redirect()->back()->with('message','No tiene los permisos asignados para acceder')->with('alert','error');

        $obj=$request->all();
        $obj['branch_id'] = $obj['branch_list'];
        unset($obj['branch_list']);
        Deposit::create($obj);
        return redirect()->to('/depositos')->with('message','Su registro se ha creado con exito')->with('alert','success');
    }


	public function show($id)
	{
		//
	}


	public function edit($id)
	{
        if(!$this->permission)
            return redirect()->back()->with('message','No tiene los permisos asignados para acceder')->with('alert','error');

        try{
        $submit='Guardar Cambios';
        $model = Deposit::findOrFail($id);
        $url='depositos';
        $action='ReferentialControllers\DepositController@update';
        list($referencial, $independiente, $controlador) = $this->sendInfo();
        $branches=Branch::all()->lists('description','id');
        return view ('deposit.edit',compact('branches','action','url','model','submit','referencial','independiente'));
        }catch(\Exception $e){
            return redirect()->back()->with('message','El registro no existe')
                ->with('alert','error');
        }
    }


    public function update($id,Requests\CreateDepositRequest $request)
    {
        if(!$this->permission)
            return redirect()->back()->with('message','No tiene los permisos asignados para acceder')->with('alert','error');

        try{
        $model = Deposit::findOrFail($id);
        $obj=$request->all();
        $obj['branch_id'] = $obj['branch_list'];
        unset($obj['branch_list']);
        $model->update($obj);
        $params = ['message'=>'Se ha guardado con exito',
            'alert'=>'success'];
        return redirect()->to('/depositos')->with($params);
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
            Deposit::destroy($id);
            return redirect()->back()->with('message', 'El registro se ha eliminado con exito')
                ->with('alert', 'success');
        }catch(QueryException $e){
            return redirect()->back()->with('message', 'El registro no ha podido ser eliminado, esta siendo utilizado actualmente')
                ->with('alert', 'error');
        }
	}

    public function sendInfo()
    {
        $referencial = 'Deposito';
        $independiente = 'Stock';
        $controlador = '\Deposit';
        return array($referencial, $independiente, $controlador);
    }

}
