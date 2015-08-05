<?php namespace App\Http\Controllers\ReferentialControllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\ReferentialModels\Position;
use Illuminate\Http\Request;

class PositionController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $positions=Position::all();
        // dd($Positions);

        return view ('position.index',compact('positions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
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
        $submit='Guardar Cambios';
        $model =Position::find($id);


        $url='cargos';
        $action='ReferentialControllers\PositionController@update';
        $edit=$model->periodo;

        $array=['Semanal'=>'Semanal','Quincenal'=>'Quincenal','Mensual'=>'Mensual'];
        return view ('Position.edit',compact('action','url','model','submit','array','edit'));

    }


    public function update(Requests\CreatePositionRequest $request, $id)
    {
        $input=$request->all();
        $Position=Position::findorFail($id);
        $Position->update($input);

        return redirect()->to('/cargos')->with('message','Su cargo se ha actualizado con exito')->with('alert','success');

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

}
