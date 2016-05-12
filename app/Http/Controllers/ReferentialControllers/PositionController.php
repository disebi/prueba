<?php namespace App\Http\Controllers\ReferentialControllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\ReferentialModels\Position;
use Illuminate\Http\Request;

class PositionController extends Controller
{

    public function __construct()
    {
        $this->permission = \Auth::user()->hasAccess('position.all');
    }

    public function index()
    {
        if(!$this->permission)
            return redirect()->back()->with('message','No tiene los permisos asignados para acceder')->with('alert','error');

        $positions = Position::all();
        // dd($Positions);
        list($referencial, $independiente) = $this->getInfo();
        return view('position.index', compact('positions', 'referencial', 'independiente'));
    }


    public function create()
    {
        if(!$this->permission)
            return redirect()->back()->with('message','No tiene los permisos asignados para acceder')->with('alert','error');

        list($referencial, $independiente) = $this->getInfo();
        $edit=0;
        $array=['Semanal'=>'Semanal','Quincenal'=>'Quincenal','Mensual'=>'Mensual'];
        return view ('position.create',compact('array','edit','referencial','independiente'));
    }


    public function store(Requests\CreatePositionRequest $request)
    {
        if(!$this->permission)
            return redirect()->back()->with('message','No tiene los permisos asignados para acceder')->with('alert','error');
        $input=$request->all();
        Position::create($request->all());
        return redirect()->to('/cargos')->with('message','Su cargo se ha creado con exito')->with('alert','success');
    }

    public function edit($id)
    {
        if(!$this->permission)
            return redirect()->back()->with('message','No tiene los permisos asignados para acceder')->with('alert','error');
        try{
        $submit='Guardar Cambios';
        $model =Position::findOrFail($id);


        $url='cargos';
        $action='ReferentialControllers\PositionController@update';
        $edit=$model->periodo;

        $array=['Semanal'=>'Semanal','Quincenal'=>'Quincenal','Mensual'=>'Mensual'];
        return view ('Position.edit',compact('action','url','model','submit','array','edit'));
        }catch(\Exception $e){
            return redirect()->back()->with('message','El registro no existe')
                ->with('alert','error');
        }
    }


    public function update(Requests\CreatePositionRequest $request, $id)
    {
        if(!$this->permission)
            return redirect()->back()->with('message','No tiene los permisos asignados para acceder')->with('alert','error');

        try{
        $input=$request->all();
        $Position=Position::findorFail($id);
        $Position->update($input);

        return redirect()->to('/cargos')->with('message','Su cargo se ha actualizado con exito')->with('alert','success');
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
        Position::destroy($id);
        return redirect()->to('/cargos')->with('message','Su cargo se ha eliminado con exito')->with('alert','success');

        }catch(QueryException $e){
        return redirect()->to('/marcas')->with('message','Su registro no ha podido ser eliminado, ya que se esta utilizando')->with('alert','error');
        }
    }

    /**
     * @return array
     */
    public function getInfo()
    {
        $referencial = "Cargo";
        $independiente = "Empleados";
        return array($referencial, $independiente);
    }

}
