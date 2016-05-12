<?php namespace App\Http\Controllers\DistributionControllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Distribution\Visit;
use App\Models\Distribution\WorkOrder;
use Illuminate\Http\Request;

class WorkController extends Controller {

    public function __construct()
    {
        $this->permission = \Auth::user()->hasAccess('workorder.all');
    }

	public function index()
	{
        if(!$this->permission)
            return redirect()->back()->with('message','No tiene los permisos asignados para acceder')->with('alert','error');

        $model=WorkOrder::orderBy('updated_at','desc')
            ->branching()->active()->paginate(10);
        list($referencial, $independiente) = $this->getInfo();
        return view('workorder.index',compact('model','branches','referencial','independiente'));
	}

    public function search()
    {
        if(!$this->permission)
            return redirect()->back()->with('message','No tiene los permisos asignados para acceder')->with('alert','error');

        $model=Visit::orderBy('updated_at','desc')
            ->branching()
            ->where('state','=',true)->paginate(10);

        list($referencial, $independiente) = $this->getInfo();
        return view('workorder.searchVisit',compact('model','branches','referencial','independiente'));
    }

	public function create()
	{

	}

    public function makeOrder($id)
    {
        if(!$this->permission)
            return redirect()->back()->with('message','No tiene los permisos asignados para acceder')->with('alert','error');

        try{
            $user=\Auth::user();
            $model=Visit::find($id);
            list($referencial, $independiente) = $this->getInfo();
            return view('workorder.create',compact('model','order','clients','products','user','referencial','independiente'));
        }catch(\Exception $e){
            return redirect()->back()->with('message','El registro no existe')
                ->with('alert','error');
        }
    }
	public function store()
	{
		//
	}


	public function show($id)
	{
		//
	}

	public function edit($id)
	{
		//
	}


	public function update($id)
	{
		//
	}

	public function destroy($id)
	{
		//
	}

    public function getInfo()
    {
        $referencial = "Orden de Trabajo";
        $independiente = "Repartos";
        return array($referencial, $independiente);
    }
}
