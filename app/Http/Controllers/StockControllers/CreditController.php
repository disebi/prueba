<?php namespace App\Http\Controllers\StockControllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\CreditRequest;
use App\Models\Distribution\Sale;
use App\Models\ReferentialModels\Product;
use App\Models\Stock\Credit;
use Illuminate\Http\Request;

class CreditController extends Controller {


    public function index()
    {

        $model=Credit::orderBy('updated_at','desc')->active()->branching()->paginate(10);
        list($referencial, $independiente) = $this->getInfo();
        return view('credit.index',compact('model','branches','referencial','independiente'));
    }

    public function search()
    {
        $model=Sale::orderBy('updated_at','desc')
            ->branching()->active()->paginate(10);

        list($referencial, $independiente) = $this->getInfo();
        return view('credit.searchOrder',compact('model','referencial','independiente'));
    }

    public function create()
    {
        //return redirect()->to('ventas/ordenes');
    }

    public function makeCredit($id)
    {
        try{
            $user=\Auth::user();
            $model=Sale::find($id);
            list($products) = $this->getCombos();
            $sale=$model->id;
            list($referencial, $independiente) = $this->getInfo();
            return view('credit.createSale',compact('model','sale','clients','products','user','referencial','independiente'));
        }catch(\Exception $e){
            return redirect()->back()->with('message','El registro no existe')
                ->with('alert','error');
        }
    }

    public function store(CreditRequest $request)
    {
        $user=\Auth::user();
        $invoice =  new Credit();
        $this->getInvoiceHeader($request, $user, $invoice);
        foreach($request['result'] as $detail){
            $pieces = explode(",", $detail);
            $invoice->products()->attach([$pieces[0]], array('cant' => $pieces[1],'price' => $pieces[2]));
        }
        return redirect()->to('/credito')->with('message','Se ha guardado con exito')->with('alert','success');
    }


    public function show($id)
    {
        $model=Credit::findOrFail($id);
        return view('credit.show',compact('model'));
    }


    public function edit($id)
    {


    }


    public function update( $request,$id)
    {

    }


    public function destroy($id)
    {
        $purchase=Credit::findOrFail($id);
        $state=false;

        $purchase->state =$state;
        $purchase->save();

        return redirect()->to('credito')->with('message','Se ha cambiado de estado con exito')->with('alert','success');
    }

    public function getInvoiceHeader(CreditRequest $request, $user, $invoice)
    {
        $input = \Input::all();
        dd($input);
        $order=Sale::find($request['sale_id']);
        $invoice->sale_id = $request['sale_id'];
        $invoice->client_id = $order->client_id;
        $invoice->branch_id = $user->staff->branch_id;
        $invoice->staff_id = $user->staff->id;
        $invoice->state = true;
        $invoice->total = $request['total'];
        $invoice->coment = $input['coment'];
        $invoice->save();
    }

    public function getInfo()
    {
        $referencial = "Notas de Credito";
        $independiente = "Pedidos Facturados a Clientes";
        return array($referencial, $independiente);
    }

    public function getCombos()
    {
        $products = Product::select(\DB::raw("id, (description || ' ' || venta) as description"))->lists('description', 'id');
        return array($products);
    }

}
