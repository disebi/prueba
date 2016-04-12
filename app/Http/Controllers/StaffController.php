<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\ReferentialModels\Branch;
use App\Models\ReferentialModels\Position;
use App\Role;
use App\Staff;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class StaffController extends Controller {

    public function index()
    {
        $tables=Staff::all();
        //dd($tables);
        //dd($tables[0]->staff()->id);
        $url='usuarios';
        list($referencial, $independiente, $controlador) = $this->sendInfo();
        return view ('staff.index',compact('url','tables','referencial','independiente','controlador'));

    }


    public function create()
    {
        list($referencial, $independiente, $controlador) = $this->sendInfo();
        $url='usuarios';
        $submit='Guardar';
        $branches=Branch::all()->lists('description','id');
        $cargos=Position::all()->lists('description','id');
        $roles=Role::all()->lists('description','id');
        $edit=0;
        return view ('staff.create',compact('roles','edit','url','referencial','independiente','controlador','submit','branches','cargos'));
    }


    public function store( Requests\CreateNewStaffRequest $request)
    {
        $obj=$request->all();

        $credentials = ['email'=>$obj['email'],
                        'password'=>'clave2adistri',
                        'name'=>$obj['nick'],
                        'role_id'=>$obj['role_list']];

        $credentials['password'] = \Hash::make($credentials['password']);


        try {
            $user = User::create($credentials);


        } catch (\Exception $e) {
            return redirect()->back()->with('message','Usuario ya existe')->with('alert','error');
        }
        $staffCredentials = ['user_id'=>$user->id,
            'branch_id'=>$obj['branch_list'],
            'position_id'=>$obj['position_list'],
            'ci'=>$obj['ci'],
            'name'=>$obj['name'],
            'last_name'=>$obj['last_name'],
            'tel'=>$obj['tel'],
            'direcc'=>$obj['direcc'],
            'birth_date'=>$obj['birth_date']];
        try {
            $staff = Staff::create($staffCredentials);

        } catch (\Exception $e) {
            return redirect()->back()->with('message','Empleado ya existe')->with('alert','error');
        }

        return redirect()->to('/usuarios')->with('message','El usuario se ha creado con exito')->with('alert','success');
    }



    public function edit($id)
    {
        $submit='Guardar Cambios';

        $staff = Staff::findOrFail($id);
        $user = User::findOrFail($staff->user_id);
        $url='usuarios';
        $action='StaffController@update';
        list($referencial, $independiente, $controlador) = $this->sendInfo();
        $branches=Branch::all()->lists('description','id');
        $cargos=Position::all()->lists('description','id');
        $roles=Role::all()->lists('description','id');
        return view ('staff.edit',compact('staff','branches','cargos','roles','action','url','user','submit','referencial','independiente'));

    }


    public function update($id,Requests\CreateNewStaffRequest $request)
    {
        $obj=$request->all();
        $staff = Staff::findOrFail($id);
        $user = User::findOrFail($staff->user_id);

        /////
        $credentials = ['email'=>$user['email'],
            'name'=>$obj['nick'],
            'role_id'=>$obj['role_list']];
        $staffCredentials = ['user_id'=>$user->id,
            'branch_id'=>$obj['branch_list'],
            'position_id'=>$obj['position_list'],
            'ci'=>$obj['ci'],
            'name'=>$obj['name'],
            'last_name'=>$obj['last_name'],
            'tel'=>$obj['tel'],
            'direcc'=>$obj['direcc'],
            'birth_date'=>$obj['birth_date']];

        $staff->update($staffCredentials);
        $user->update($credentials );
        $params = ['message'=>'Se ha guardado con exito',
            'alert'=>'success'];
        return redirect()->to('/usuarios')->with($params);
    }

    public function destroy($id)
    {
        try{
            User::destroy($id);
            return redirect()->back()->with('message', 'El registro se ha eliminado con exito')
                ->with('alert', 'success');
        }catch(QueryException $e){
            return redirect()->back()->with('message', 'El registro no ha podido ser eliminado, esta siendo utilizado actualmente')
                ->with('alert', 'error');
        }
    }

    public function sendInfo()
    {
        $referencial = 'Usuarios';
        $independiente = 'Empleados';
        $controlador = '\Staff';
        return array($referencial, $independiente, $controlador);
    }
}
