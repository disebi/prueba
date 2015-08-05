<?php namespace App\Http\Controllers\ReferentialControllers;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\ReferentialModels\Branch;
use Illuminate\Http\Request;

class BranchController extends Controller {

    public function index()
    {
        $branches=Branch::all();
        // dd($branchs);

        return view ('branch.index',compact('branches'));
    }


    public function create()
    {

        return view ('branch.create');
    }


    public function store(Requests\CreateBranchRequest $request)
    {
        $input=$request->all();
        Branch::create($request->all());

        return redirect()->to('/sucursales')->with('message','Su Sucursal se ha creado con exito')->with('alert','success');

    }


    public function edit($id)
    {
        $submit='Guardar Cambios';
        $model =Branch::find($id);


        $url='sucursales';
        $action='ReferentialControllers\BranchController@update';


        return view ('branch.edit',compact('action','url','model','submit'));

    }


    public function update(Requests\CreateBranchRequest $request, $id)
    {
        $input=$request->all();
        $branch=Branch::findorFail($id);
        $branch->update($input);

        return redirect()->to('/sucursales')->with('message','Su sucursal se ha actualizado con exito')->with('alert','success');

    }


    public function destroy($id)
    {

        try{
        Branch::destroy($id);
        return redirect()->to('/sucursales')->with('message','Su sucursal se ha eliminado con exito')->with('alert','success');
        }

        catch(QueryException $e){
        return redirect()->to('/sucursales')->with('message','Su registro no ha podido ser eliminado, ya que se esta utilizando')->with('alert','error');
        }
    }

}
