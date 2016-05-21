<?php namespace App\Http\Controllers\DistributionControllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Distribution\Order;
use App\Models\Distribution\Visit;
use App\Models\Distribution\ZoneAssign;
use App\Models\ReferentialModels\Client;
use App\Models\ReferentialModels\Product;
use App\Models\ReferentialModels\Zone;
use App\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class VisitController extends Controller {

    public function __construct()
    {
        $this->permission = \Auth::user()->hasAccess('visit.all');
    }

	public function index()
	{
        if(!$this->permission)
            return redirect()->back()->with('message','No tiene los permisos asignados para acceder')->with('alert','error');

        $user=\Auth::user();
        $model=Visit::orderBy('updated_at','desc')
            ->branching()->active()->paginate(10);
        list($referencial, $independiente) = $this->getInfo();
        return view('visits.index',compact('model','branches','referencial','independiente'));
	}


	public function create()
	{
        if(!$this->permission)
            return redirect()->back()->with('message','No tiene los permisos asignados para acceder')->with('alert','error');

        $taken_zones = ZoneAssign::select('zone_id')->lists('zone_id');
        $products = Product::all()->lists('description','id');
        $branch_id = \Auth::user()->staff->branch_id;
        $zones = Zone::select(\DB::raw("zones.id, zones.description"))
            ->join('cities', 'zones.city_id', '=', 'cities.id')
            ->join('branches', 'cities.branch_id', '=', 'branches.id')
            ->where('cities.branch_id', '=', $branch_id)
            ->whereIn('zones.id', $taken_zones)
            ->lists('description', 'id');

        list($referencial, $independiente) = $this->getInfo();
        return view('visits.create',compact('referencial','independiente','zones','products'));
	}


	public function store()
	{
        if(!$this->permission)
            return redirect()->back()->with('message','No tiene los permisos asignados para acceder')->with('alert','error');

        $input= \Input::all();
        $input= $input['zone'];
        $visit =  new Visit();
        $this->getVisitHeader($input, $visit);
        $user=\Auth::user();

        foreach($input['sending'] as $order){
            $invoice =  new Order();
            $this->getInvoiceHeader($order, $user, $invoice,$visit->id);
            foreach($order['products'] as $detail){
                $invoice->products()->attach([$detail[0]], array('cant' => $detail[1],'price' => $detail[2]));
            }}
        return ['state'=>true,'id'=>$visit->id];
	}


	public function show($id)
	{
        if(!$this->permission)
            return redirect()->back()->with('message','No tiene los permisos asignados para acceder')->with('alert','error');

        $model= Visit::find($id);
        return view('visits.show',compact('model'));
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
        if(!$this->permission)
            return redirect()->back()->with('message','No tiene los permisos asignados para acceder')->with('alert','error');

        $purchase=Visit::findOrFail($id);

        if($purchase->orders()->active()->count()>0){
         return redirect()->to('visitas')->with('message','No se ha podido deshabilitar su visita, ya que posee pedidos activos')->with('alert','error');

        }

        $state=false;
        if(!$purchase->state){
            $state=true;
        }
        $purchase->state =$state;
        $purchase->save();
        return redirect()->to('visitas')->with('message','Se ha cambiado de estado con exito')->with('alert','success');

    }

    public function getInfo()
    {
        if(!$this->permission)
            return redirect()->back()->with('message','No tiene los permisos asignados para acceder')->with('alert','error');

        $referencial = "Visitas";
        $independiente = "Clientes";
        return array($referencial, $independiente);
    }
    public function getZone()
    {
        $input= \Input::all();
        $zone= Zone::find($input['zone']);
        $clients=Client::select('id','description')->where('zona_id','=',$input['zone'])->get();
        return [['description'=>$zone->description,'salesman'=>$zone->assign->staff->name.' '.$zone->assign->staff->last_name,'city'=>$zone->city->description],$clients];
    }

    public function getVisitHeader( $request, $visit)
    {
        $zone = Zone::find($request['zone_id']);
        $visit->zone_id = $request['zone_id'];
        $visit->branch_id = $zone->city->branch_id;
        $visit->staff_id = $zone->assign->staff->id;
        $visit->delivery_date = $request['delivery_date'];
        $visit->process = 1;
        $visit->state = TRUE;
        $visit->save();
    }

    public function getInvoiceHeader($request, $user, $invoice,$visit_id)
    {
        $invoice->branch_id = $user->staff->branch_id;
        $invoice->client_id = $request['client_id'];
        $invoice->staff_id = $user->staff->id;
        $invoice->visit_id = $visit_id;
        $invoice->total = $request['total'];
        $invoice->coment = $request['coment'];
        $invoice->save();
    }
}
