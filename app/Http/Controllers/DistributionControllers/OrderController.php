<?php namespace App\Http\Controllers\DistributionControllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\OrderRequest;
use App\Models\Distribution\Order;
use App\Models\Distribution\Visit;
use App\Models\ReferentialModels\Branch;
use App\Models\ReferentialModels\Product;
use Illuminate\Http\Request;

class OrderController extends Controller {


	public function index()
	{
        $user=\Auth::user();
        $model=Order::orderBy('updated_at','desc')->active()->branching()->paginate(10);
        list($referencial, $independiente) = $this->getInfo();
        return view('orders.index',compact('model','branches','referencial','independiente'));
	}


	public function search()
	{

        $user=\Auth::user();
        $model=Visit::orderBy('updated_at','desc')
            ->where('branch_id','=',$user->staff->branch_id)
            ->where('state','=',true)->paginate(10);
        //$model[0]->details()->sum('price'

        $branches=Branch::all();
        list($referencial, $independiente) = $this->getInfo();
        return view('orders.searchVisit',compact('model','branches','referencial','independiente'));
	}

    public function create()
    {
        return redirect()->to('ordenes/visitas');
    }

    public function makeOrder($id)
    {
        $user=\Auth::user();
        list($clients, $products) = $this->getCombos($id);
        $visit=$id;
        list($referencial, $independiente) = $this->getInfo();
        return view('orders.create',compact('visit','clients','products','user','referencial','independiente'));
    }
	public function store(OrderRequest $request)
	{
        $user=\Auth::user();
        $invoice =  new Order;
        $this->getInvoiceHeader($request, $user, $invoice);
        foreach($request['result'] as $detail){
            $pieces = explode(",", $detail);
            $invoice->products()->attach([$pieces[0]], array('cant' => $pieces[1],'price' => $pieces[2]));
        }
        return redirect()->to('/ordenes')->with('message','Se ha guardado con exito')->with('alert','success');
	}


	public function show($id)
	{
        $model=Order::findOrFail($id);
        return view('orders.show',compact('model'));
	}


	public function edit($id)
	{

        try{
            $user=\Auth::user();
            $model=Order::find($id);
            list($clients, $products) = $this->getCombos($model->visit_id);
        $visit=$model->visit_id;
            list($referencial, $independiente) = $this->getInfo();
            return view('orders.edit',compact('model','visit','clients','products','user','referencial','independiente'));
        }catch(\Exception $e){
            return redirect()->back()->with('message','El registro no existe')
                ->with('alert','error');
        }
	}


	public function update(OrderRequest $request,$id)
	{
        try{
            $user=\Auth::user();
            $invoice =  Order::findOrFail($id);
            $this->getInvoiceHeader($request, $user, $invoice);
            $invoice->products()->detach();
            foreach($request['result'] as $detail){
                $pieces = explode(",", $detail);
                $invoice->products()->attach([$pieces[0]], array('cant' => $pieces[1],'price' => $pieces[2]));
            }
            return redirect()->to('/ordenes')->with('message','Se ha guardado con exito')->with('alert','success');
        }catch(\Exception $e){
            return redirect()->back()->with('message','El registro no existe')
                ->with('alert','error');
        }
	}


	public function destroy($id)
	{
        $purchase=Order::findOrFail($id);
        $state=false;
        if(!$purchase->state){
            $state=true;
        }
        $purchase->state =$state;
        $purchase->save();

        return redirect()->to('ordenes')->with('message','Se h  a cambiado de estado con exito')->with('alert','success');
	}

    public function getInvoiceHeader(OrderRequest $request, $user, $invoice)
    {
        $input = \Input::all();
        $invoice->visit_id = $request['visit_id'];
        $invoice->client_id = $request['client_list'];
        $invoice->branch_id = $user->staff->branch_id;
        $invoice->staff_id = $user->staff->id;
        $invoice->state = true;
        $invoice->total = $request['total'];
        $invoice->coment = $input['coment'];

        $invoice->save();
    }

    public function getInfo()
    {
        $referencial = "Ordenes";
        $independiente = "Clientes";
        return array($referencial, $independiente);
    }

    public function getCombos($id)
    {
        $clients = Visit::find($id)->zone->local->lists('description', 'id');

        $clients[0] = 'Favor seleccione un cliente';
        asort($clients);
        $products = Product::select(\DB::raw("id, (description || ' ' || venta) as description"))->lists('description', 'id');
        return array($clients, $products);
    }
}
