<?php namespace App\Http\Controllers\ReferentialControllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\ReferentialModels\Position;
use Illuminate\Http\Request;

class PositionController extends Controller
{

    public function index()
    {
        $positions = Position::all();
        // dd($Positions);
        list($referencial, $independiente) = $this->getInfo();
        return view('position.index', compact('positions', 'referencial', 'independiente'));
    }


    public function create()
    {
        list($referencial, $independiente) = $this->getInfo();
        $edit=0;
        $array=['Semanal'=>'Semanal','Quincenal'=>'Quincenal','Mensual'=>'Mensual'];
        return view ('position.create',compact('array','edit'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Requests\CreatePositionRequest $request)
    {
        $input=$request->all();
        Position::create($request->all());

        return redirect()->to('/cargos')->with('message','Su cargo se ha creado con exito')->with('alert','success');

    }


    public function edit($id)
    {
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {

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
