<?php namespace App\Http\Controllers\ReferentialControllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\ReferentialModels\Branch;
use App\Models\ReferentialModels\Deposit;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class DepositController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $tables=Deposit::all();
        $url='depositos';
        list($referencial, $independiente, $controlador) = $this->sendInfo();
        return view ('deposit.index',compact('url','tables','referencial','independiente','controlador'));

    }

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        list($referencial, $independiente, $controlador) = $this->sendInfo();
        $url='depositos';
        $submit='Guardar';
        $branches=Branch::all()->lists('description','id');
        $edit=0;
        return view ('deposit.create',compact('edit','url','referencial','independiente','controlador','submit','branches'));

    }

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
    public function store(Requests\CreateDepositRequest $request)
    {
        $obj=$request->all();
        $obj['branch_id'] = $obj['branch_list'];
        unset($obj['branch_list']);
        Deposit::create($obj);
        return redirect()->to('/depositos')->with('message','Su registro se ha creado con exito')->with('alert','success');
    }

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
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

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function update($id,Requests\CreateDepositRequest $request)
    {
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

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
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
