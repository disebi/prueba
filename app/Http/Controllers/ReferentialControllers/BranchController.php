<?php namespace App\Http\Controllers\ReferentialControllers;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\ReferentialModels\Branch;
use App\Models\ReferentialModels\Deposit;
use Illuminate\Http\Request;

class BranchController extends Controller {

    public function __construct()
    {
        $this->permission = \Auth::user()->hasAccess('branch.all');
    }
    public function index()
    {
        if(!$this->permission)
            return redirect()->back()->with('message','No tiene los permisos asignados para acceder')->with('alert','error');

        $branches=Branch::all();
        list($referencial, $independiente) = $this->getInfo();
        return view ('branch.index',compact('branches','referencial','independiente'));
    }

    public function create()
    {
        if(!$this->permission)
            return redirect()->back()->with('message','No tiene los permisos asignados para acceder')->with('alert','error');

        list($referencial, $independiente) = $this->getInfo();
        return view ('branch.create',compact('referencial','independiente'));
    }


    public function store(Requests\CreateBranchRequest $request)
    {
        if(!$this->permission)
            return redirect()->back()->with('message','No tiene los permisos asignados para acceder')->with('alert','error');

        $input=$request->all();
        $branch=Branch::create($request->all());

        $depositBranch=['description'=>$input['description'],
                        'branch_id'=>$branch->id];

        Deposit::create($depositBranch);
        return redirect()->to('/sucursales')->with('message','Su Sucursal se ha creado con exito')->with('alert','success');
    }


    public function edit($id)
    {
        if(!$this->permission)
            return redirect()->back()->with('message','No tiene los permisos asignados para acceder')->with('alert','error');

        $submit='Guardar Cambios';
        list($referencial, $independiente) = $this->getInfo();
        try{
            $model =Branch::findOrFail($id);
            $url='sucursales';
            $action='ReferentialControllers\BranchController@update';
            return view ('branch.edit',compact('action','url','model','submit','referencial','independiente'));
        }catch (\Exception $e){
            return redirect()->back()->with('message','No existe la sucursal requerida')->with('alert','error');
        }
    }


    public function update(Requests\CreateBranchRequest $request, $id)
    {
        if(!$this->permission)
            return redirect()->back()->with('message','No tiene los permisos asignados para acceder')->with('alert','error');

        $input=$request->all();
        try{
            $branch=Branch::findOrFail($id);
            $branch->update($input);
            return redirect()->to('/sucursales')->with('message','Su sucursal se ha actualizado con exito')->with('alert','success');
        }catch (\Exception $e){
            return redirect()->back()->with('message','No existe la sucursal requerida')->with('alert','error');
        }
    }


    public function destroy($id)
    {
        if(!$this->permission)
            return redirect()->back()->with('message','No tiene los permisos asignados para acceder')->with('alert','error');

        try{
        Branch::destroy($id);
        return redirect()->to('/sucursales')->with('message','Su sucursal se ha eliminado con exito')->with('alert','success');
        }
        catch(QueryException $e){
        return redirect()->to('/sucursales')->with('message','Su registro no ha podido ser eliminado, ya que se esta utilizando')->with('alert','error');
        }
    }

    public function getInfo()
    {
        $referencial = "Sucursal";
        $independiente = "Empresa";
        return array($referencial, $independiente);
    }

}
