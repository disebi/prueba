<?php namespace App\Http\Controllers\DistributionControllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\SaleRequest;
use App\Models\Distribution\Order;
use App\Models\Distribution\Sale;
use App\Models\Distribution\Visit;
use App\Models\ReferentialModels\Product;
use App\Models\ReferentialModels\Stamping;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SaleController extends Controller {

    public function __construct()
    {
        $this->permission = \Auth::user()->hasAccess('sale.all');
    }
	public function index()
	{
        if(!$this->permission)
            return redirect()->back()->with('message','No tiene los permisos asignados para acceder')->with('alert','error');

        $model=Sale::orderBy('updated_at','desc')->active()->branching()->paginate(10);
        list($referencial, $independiente) = $this->getInfo();
        return view('sales.index',compact('model','branches','referencial','independiente'));
	}

    public function search()
    {
        if(!$this->permission)
            return redirect()->back()->with('message','No tiene los permisos asignados para acceder')->with('alert','error');

        $model=Order::orderBy('updated_at','desc')
            ->branching()
            ->pendent()
            ->where('state','=',true)->paginate(10);

        list($referencial, $independiente) = $this->getInfo();
        return view('sales.searchOrder',compact('model','branches','referencial','independiente'));
    }

    public function create()
    {
        //return redirect()->to('ventas/ordenes');
    }

    public function makeSale($id)
    {
        if(!$this->permission)
            return redirect()->back()->with('message','No tiene los permisos asignados para acceder')->with('alert','error');

        try{
            $user=\Auth::user();
            $model=Order::find($id);
            list($products) = $this->getCombos();
            $order=$model->id;
            list($referencial, $independiente) = $this->getInfo();
            return view('sales.createSale',compact('model','order','clients','products','user','referencial','independiente'));
        }catch(\Exception $e){
            return redirect()->back()->with('message','El registro no existe')
                ->with('alert','error');
        }
    }

    public function store(SaleRequest $request)
    {
        if(!$this->permission)
            return redirect()->back()->with('message','No tiene los permisos asignados para acceder')->with('alert','error');

        $stamping= $this->getStamping();
        if($stamping == false)
            return redirect()->to('/ventas')->with('message','No existe un timbrado habilitado para realizar facturas')
        ->with('alert','error');
        $user=\Auth::user();
        $invoice =  new Sale;
        $this->getInvoiceHeader($request, $user, $invoice,$stamping);
        foreach($request['result'] as $detail){
            $pieces = explode(",", $detail);
            $invoice->products()->attach([$pieces[0]], array('cant' => $pieces[1],'price' => $pieces[2]));
        }
        return redirect()->to('/ventas')->with('message','Se ha guardado con exito')->with('alert','success');
    }


    public function show($id)
    {
        if(!$this->permission)
            return redirect()->back()->with('message','No tiene los permisos asignados para acceder')->with('alert','error');

        $model=Sale::findOrFail($id);
        return view('sales.show',compact('model'));
    }


    public function edit($id)
    {


    }


    public function update( $request,$id)
    {

    }


    public function destroy($id)
    {
        if(!$this->permission)
            return redirect()->back()->with('message','No tiene los permisos asignados para acceder')->with('alert','error');

        $purchase=Sale::findOrFail($id);
        $state=false;

        $purchase->state =$state;
        $purchase->save();
        $order= Order::find($purchase->order_id);
        $order->process=1;
        $order->save();

        return redirect()->to('ventas')->with('message','Se h  a cambiado de estado con exito')->with('alert','success');
    }

    public function getInvoiceHeader(SaleRequest $request, $user, $invoice,$stamping)
    {
        if(!$this->permission)
            return redirect()->back()->with('message','No tiene los permisos asignados para acceder')->with('alert','error');

        $order=Order::find($request['order_id']);
        $input = \Input::all();
        $invoice->order_id = $request['order_id'];
        $invoice->salesman_id = $order->staff->id;
        $invoice->client_id = $order->client_id;
        $invoice->branch_id = $user->staff->branch_id;
        $invoice->stamping = $stamping;
        $invoice->staff_id = $user->staff->id;
        $invoice->iva_10 = $request['iva_10'];
        $invoice->iva_5 = $request['iva_5'];
        $invoice->exent = $request['excento'];
        $invoice->state = true;
        $invoice->total = $request['total'];
        $invoice->coment = $input['coment'];
        $invoice->save();
        $order->process=3;
        $order->save();
    }

    public function getInfo()
    {
        $referencial = "Ventas";
        $independiente = "Clientes";
        return array($referencial, $independiente);
    }

    public function getCombos()
    {
        $products = Product::select(\DB::raw("id, (description || ' ' || venta) as description"))->lists('description', 'id');
        return array($products);
    }

    public function getStamping(){
        $stampings_count=Stamping::where('do','>',Carbon::today())->count();
        $stamping=Stamping::where('do','>=',Carbon::today())->orderBy('created_at','desc')->first();

        if($stampings_count==0)
                return false;
        $sales=Sale::orderBy('created_at','desc')->first();
        if( $sales == null || $sales->stamping< $stamping->from)
            return $stamping->from;

        if($sales->stamping > $stamping->from && $sales->stamping < $stamping->to )
            return $sales->stamping++;

        if($sales->stamping == $stamping->to )
            return false;

    }
}
