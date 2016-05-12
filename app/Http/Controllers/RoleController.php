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

    public function __construct()
    {
        $this->permission = \Auth::user()->hasAccess('role.all');
    }

    public function index()
    {
        if(!$this->permission)
            return redirect()->back()->with('message','No tiene los permisos asignados para acceder')->with('alert','error');

        $tables=Role::all();
        $url='roles';
        list($referencial, $independiente, $controlador) = $this->sendInfo();
        return view ('role.index',compact('url','tables','referencial','independiente','controlador'));

    }

	public function create()
	{
        if(!$this->permission)
            return redirect()->back()->with('message','No tiene los permisos asignados para acceder')->with('alert','error');

        list($referencial, $independiente, $controlador) = $this->sendInfo();
        $url='roles';
        $submit='Guardar';
        $licenses=License::all()->lists('description','id');
        $edit=0;
        return view ('role.create',compact('edit','url','referencial','independiente','controlador','submit','licenses'));

    }


	public function store(Requests\CreateRoleRequest $request)
    {
        if(!$this->permission)
            return redirect()->back()->with('message','No tiene los permisos asignados para acceder')->with('alert','error');

        $obj = $request->all();
        $role = Role::create(['description' => $obj['description']]);
        $role->licenses()->attach($obj['license_list']);
        return redirect()->to('/roles')->with('message', 'Su registro se ha creado con exito')->with('alert', 'success');
    }


	public function show($id)
	{
        if(!$this->permission)
            return redirect()->back()->with('message','No tiene los permisos asignados para acceder')->with('alert','error');

    }


	public function edit($id)
	{
        if(!$this->permission)
            return redirect()->back()->with('message','No tiene los permisos asignados para acceder')->with('alert','error');

        $submit='Guardar Cambios';
        $model = Role::findOrFail($id);
        $url='roles';
        $action='RoleController@update';
        list($referencial, $independiente, $controlador) = $this->sendInfo();
        $licenses=License::all()->lists('description','id');
        return view ('role.edit',compact('licenses','action','url','model','submit','referencial','independiente'));
	}

	public function update($id)
	{
        if(!$this->permission)
            return redirect()->back()->with('message','No tiene los permisos asignados para acceder')->with('alert','error');

        $obj=\Input::all();
        $role=Role::find($id);
        $role->licenses()->sync($obj['license_list']);
        $role->update(['description'=>$obj['description']]);

        return redirect()->to('/roles')->with('message','Su registro se ha creado con exito')->with('alert','success');
 	}


	public function destroy($id)
	{
        if(!$this->permission)
            return redirect()->back()->with('message','No tiene los permisos asignados para acceder')->with('alert','error');

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
