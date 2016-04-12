<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\License;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class RoleController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
    public function index()
    {
        $tables=Role::all();
        $url='roles';
        list($referencial, $independiente, $controlador) = $this->sendInfo();
        return view ('role.index',compact('url','tables','referencial','independiente','controlador'));

    }

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        list($referencial, $independiente, $controlador) = $this->sendInfo();
        $url='roles';
        $submit='Guardar';
        $licenses=License::all()->lists('description','id');
        $edit=0;
        return view ('role.create',compact('edit','url','referencial','independiente','controlador','submit','licenses'));

    }

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Requests\CreateRoleRequest $request)
    {

        $obj = $request->all();
        $role = Role::create(['description' => $obj['description']]);
        $role->licenses()->attach($obj['license_list']);
        return redirect()->to('/roles')->with('message', 'Su registro se ha creado con exito')->with('alert', 'success');
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
	{   //dd( \Auth::user()->hasAccess('presentacion.all'));

        $submit='Guardar Cambios';
        $model = Role::findOrFail($id);
        $url='roles';
        $action='RoleController@update';
        list($referencial, $independiente, $controlador) = $this->sendInfo();
        $licenses=License::all()->lists('description','id');
        return view ('role.edit',compact('licenses','action','url','model','submit','referencial','independiente'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
        //      $obj=$request->all();
        $obj=\Input::all();
        //$obj['branch_id'] = $obj['branch_list'];
        //unset($obj['branch_list']);
        $role=Role::find($id);
        $role->licenses()->sync($obj['license_list']);
        $role->update(['description'=>$obj['description']]);

        return redirect()->to('/roles')->with('message','Su registro se ha creado con exito')->with('alert','success');
        //
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
            $role=Role::find($id);
            $role->licenses()->detach();
            Role::destroy($id);
            return redirect()->back()->with('message', 'El registro se ha eliminado con exito')
                ->with('alert', 'success');
        }catch(QueryException $e){
            return redirect()->back()->with('message', 'El registro no ha podido ser eliminado, esta siendo utilizado actualmente')
                ->with('alert', 'error');
        }
	}

    public function sendInfo()
    {
        $referencial = 'Rol';
        $independiente = 'Usuario';
        $controlador = '\Role';
        return array($referencial, $independiente, $controlador);
    }
}
