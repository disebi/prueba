<?php namespace App\Http\Controllers\DistributionControllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Distribution\Out;
use App\Models\Distribution\WorkOrder;
use App\Models\ReferentialModels\Drive;
use App\Models\Stock\Remission;
use App\Staff;
use Illuminate\Http\Request;

class OutController extends Controller {

    public function __construct()
    {
        $this->permission = \Auth::user()->hasAccess('out.all');
    }
	public function index()
	{
		if(!$this->permission)
            return redirect()->back()->with('message','No tiene los permisos asignados para acceder')->with('alert','error');
        $user=\Auth::user();
        $model=Out::orderBy('updated_at','desc')->active()->branch()->paginate(10);
        list($referencial, $independiente) = $this->getInfo();
        return view('out.index',compact('model','referencial','independiente'));
	}


	public function create()
	{
		if(!$this->permission)
            return redirect()->back()->with('message','No tiene los permisos asignados para acceder')->with('alert','error');
        $razon=[0=>'Otro',1=>'Entrega',2=>'Remision'];
        list($referencial, $independiente) = $this->getInfo();
        $staff= Staff::select(\DB::raw("staff.id, (staff.name || ' ' || staff.last_name) as description"))
            ->join('users', 'staff.user_id', '=', 'users.id')
            ->branching()
            ->lists('description','id');
        $drives = Drive::lists('description','id');
        return view('out.create',compact('model','razon','referencial','independiente','staff','drives'));
	}

    public function getRazons()
    {
        $razon = \Input::get('razon');
        if($razon ==1){
            $works = WorkOrder::select(\DB::raw('work_orders.id,work_orders.created_at,zones.description, work_orders.comments, work_orders.visit_id') )
                ->join('visits', 'work_orders.visit_id', '=', 'visits.id')
                ->join('zones', 'visits.zone_id', '=', 'zones.id')
                ->active()
                ->branching()->accepted()->get();

            return $works;
        }elseif($razon ==2){
            $remi = Remission::select(\DB::raw('remissions.id,remissions.created_at,branches.description, staff.name,staff.last_name') )
                ->join('branches', 'remissions.branch_to', '=', 'branches.id')
                ->join('staff', 'remissions.staff_id', '=', 'staff.id')
                ->active()
                ->branching()->pendent()->get();
            return $remi;
        }
    }


	public function store( Requests\OutRequest $request)
	{
		if(!$this->permission)
            return redirect()->back()->with('message','No tiene los permisos asignados para acceder')->with('alert','error');

        $out =  new Out();
        $this->getVisitHeader($request, $out);
        return redirect()->to('/salidas')->with('message','No tiene los permisos asignados para acceder')->with('alert','success');

    }

	public function show($id)
	{
		if(!$this->permission)
            return redirect()->back()->with('message','No tiene los permisos asignados para acceder')->with('alert','error');
        $out=Out::findOrFail($id);
        list($referencial, $independiente) = $this->getInfo();

        return view('out.show',compact('out','referencial','independiente'));

    }

	public function edit($id)
	{
		if(!$this->permission)
            return redirect()->back()->with('message','No tiene los permisos asignados para acceder')->with('alert','error');
        $model=Out::findOrFail($id);
        $razon=[0=>'Otro',1=>'Entrega',2=>'Remision'];
        list($referencial, $independiente) = $this->getInfo();
        $staff= Staff::select(\DB::raw("staff.id, (staff.name || ' ' || staff.last_name) as description"))
            ->join('users', 'staff.user_id', '=', 'users.id')
            ->branching()
            ->lists('description','id');
        $drives = Drive::lists('description','id');
        return view('out.edit',compact('model','razon','referencial','independiente','staff','drives'));

    }

	public function update($id, Requests\OutRequest $request)
	{
		if(!$this->permission)
            return redirect()->back()->with('message','No tiene los permisos asignados para acceder')->with('alert','error');
            $out = Out::find($id);
        $out->drive_id  = $request['drive_id'];
        $out->driver_id = $request['driver_id'];
        $out->km  = $request['km'];
        $out->tanque = $request['tanque'];
        $out->comments = $request['comments'];
        $out->save();
        return redirect()->to('salidas')->with('message','Se ha actualizado con exito')->with('alert','success');


    }


	public function destroy($id)
	{
		if(!$this->permission)
            return redirect()->back()->with('message','No tiene los permisos asignados para acceder')->with('alert','error');
        $out=Out::findOrFail($id);
        $out->state =false;
        $out->save();
        if($out->razon == 1){
            $work = WorkOrder::find($out->razon_id);
            $work->process = 1;
            $work->save();
        }elseif($out->razon == 2){
            $remi = Remission::find($out->razon_id);
            $remi->process = 0;
            $remi->save();
        }
        return redirect()->to('salidas')->with('message','Se ha cambiado de estado con exito')->with('alert','success');
    }

    public function getInfo()
    {
        $referencial = "Salida";
        $independiente = "Vehiculos";
        return array($referencial, $independiente);
    }

    public function getVisitHeader( $request, $out)
    {
        $out->drive_id  = $request['drive_id'];
        $out->staff_id = \Auth::user()->staff->id;
        $out->driver_id = $request['driver_id'];
        $out->branch_id = \Auth::user()->staff->branch_id;
        $out->razon  =  $request['razon'];
        if(isset($request['razon_id'])){
            $out->razon_id  =  $request['razon_id'];
        }
        if($request['razon']==1){
            $out->work_id  =  $request['razon_id'];
        }

        $out->state  = true;
        $out->km  = $request['km'];
        $out->tanque = $request['tanque'];
        $out->comments = $request['comments'];
        $out->process = 0;
        $out->state = TRUE;
        $out->save();
        if($request['razon']==1){
            $out->work_id  =  $request['razon_id'];
            $work =WorkOrder::find($request['razon_id']);
            $work->setOut();
        }
    }
}
