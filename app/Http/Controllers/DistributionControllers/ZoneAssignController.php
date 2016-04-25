<?php namespace App\Http\Controllers\DistributionControllers;


use App\Http\Requests;
use App\Http\Controllers\Controller;


use App\Http\Requests\ZoneAssignRequest;
use App\Models\Distribution\ZoneAssign;
use App\Models\ReferentialModels\City;
use App\Models\ReferentialModels\Zone;
use App\Staff;
use Illuminate\Http\Request;

class ZoneAssignController extends Controller {

	public function index()
    {
       $branch_id = \Auth::user()->staff->branch_id;
       $taken_staff = ZoneAssign::select('staff_id')->lists('staff_id');
       $staff= Staff::select(\DB::raw("staff.id, (staff.name || ' ' || staff.last_name) as description"))
                ->join('users', 'staff.user_id', '=', 'users.id')
                ->where('staff.branch_id', '=', $branch_id)
                ->lists('description','id');
        $input=\Input::all();
        if(isset($input['staff_list'])){
            $tables=Staff::where('id','=',$input['staff_list'])->paginate(1);
        }else{
            $tables=Staff::where('branch_id','=',$branch_id)
                ->whereIn('id',$taken_staff)
                ->paginate(10);
        }
        list($referencial, $independiente) = $this->sendInfo();
        return view ('zoneAssign.index',compact('url','staff','tables','referencial','independiente','controlador'));
    }


    public function create()
	{
        list($zones, $staff) = $this->getZonesInfo();
        list($referencial, $independiente) = $this->sendInfo();
        $url='asignaciones';
        $submit='Guardar';
        $edit=0;
        return view ('zoneAssign.create',compact('edit','url','referencial','independiente','controlador','submit','zones','staff'));
	}


	public function store(ZoneAssignRequest $request)
	{
        $obj = $request->all();
        $staff = Staff::find($obj['staff_list']);
        $staff->zones()->attach($obj['zones_list']);
        return redirect()->to('/asignaciones')->with('message', 'Su registro se ha creado con exito')->with('alert', 'success');
	}

	public function show($id)
	{

	}


	public function edit($id)
	{
        $submit='Guardar Cambios';
        $model = Staff::findOrFail($id);
        $url='roles';
        $action='DistributionControllers\ZoneAssignController@update';
        list($referencial, $independiente) = $this->sendInfo();
        $zones = $this->getZonesForEdit($id);
        return view ('zoneAssign.edit',compact('staff','zones','action','url','model','submit','referencial','independiente'));
	}


	public function update($id)
	{
        $obj=\Input::all();
        $staff=Staff::find($id);
        $staff->zones()->sync($obj['zones_list']);
        return redirect()->to('/asignaciones')->with('message','Su registro se ha creado con exito')->with('alert','success');
	}


	public function destroy($id)
	{
        $obj=\Input::all();
        $staff=Staff::find($id);
        $staff->zones()->detach();
        return redirect()->to('/asignaciones')->with('message','Su registro se ha creado con exito')->with('alert','success');
	}

    public function sendInfo()
    {
        $referencial = 'Asignacion de Zona';
        $independiente = 'Empleados';
        return array($referencial, $independiente);
    }

    public function getZonesInfo()
    {
        $taken_zones = ZoneAssign::select('zone_id')->lists('zone_id');
        $taken_staff = ZoneAssign::select('staff_id')->lists('staff_id');

        $branch_id = \Auth::user()->staff->branch_id;
        $zones = Zone::select(\DB::raw("zones.id, zones.description"))
            ->join('cities', 'zones.city_id', '=', 'cities.id')
            ->join('branches', 'cities.branch_id', '=', 'branches.id')
            ->whereNotIn('zones.id', $taken_zones)
            ->where('cities.branch_id', '=', $branch_id)
            ->lists('description', 'id');

        $staff = Staff::select(\DB::raw("staff.id, (staff.name || ' ' || staff.last_name) as description"))
            ->join('users', 'staff.user_id', '=', 'users.id')
            ->where('branch_id', '=', $branch_id)
            ->whereNotIn('staff.id', $taken_staff)
            ->where('users.active', '=', TRUE)
            ->lists('description', 'id');
        return array($zones, $staff);
    }

    public function getZonesForEdit($id)
    {
        $branch_id = \Auth::user()->staff->branch_id;
        $taken_zones = ZoneAssign::select('zone_id')->where('staff_id', '!=', $id)->lists('zone_id');
        $zones = Zone::select(\DB::raw("zones.id, zones.description"))->join('cities', 'zones.city_id', '=', 'cities.id')
            ->join('branches', 'cities.branch_id', '=', 'branches.id')
            ->whereNotIn('zones.id', $taken_zones)
            ->where('cities.branch_id', '=', $branch_id)
            ->lists('description', 'id');
        return $zones;
    }
}
