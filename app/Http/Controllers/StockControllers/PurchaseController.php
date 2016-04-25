<?php namespace App\Http\Controllers\StockControllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateNewPurchaseRequest;
use App\Models\ReferentialModels\Branch;
use App\Models\ReferentialModels\Line;

use App\Models\ReferentialModels\Product;
use App\Models\ReferentialModels\Provider;
use App\Models\Stock\Purchase;
use App\Models\Stock\PurchaseDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PurchaseController extends Controller {


	public function index()
	{
        $user=\Auth::user();
		$model=Purchase::orderBy('updated_at','desc')
            ->where('branch_id','=',$user->staff->branch_id)
            ->where('state','=',true)->paginate(10);
		$branches=Branch::all();
        list($referencial, $independiente) = $this->getInfo();
        return view('purchase.index',compact('model','branches','referencial','independiente'));
	}

	public function create()
	{
        $user=\Auth::user();
        $providers = Provider::all()->lists('description', 'id');
        $providers[0] = 'Favor seleccione un proveedor';
        asort($providers);
        $lines = Line::all()->lists('description', 'id');
        list($referencial, $independiente) = $this->getInfo();
		return view('purchase.create',compact('lines','providers','user','referencial','independiente'));
	}


	public function store(CreateNewPurchaseRequest $request)
	{
       $user=\Auth::user();
       $invoice =  new Purchase;
       $this->getInvoiceHeader($request, $user, $invoice);
       foreach($request['result'] as $detail){
        $pieces = explode(",", $detail);
        $invoice->products()->attach([$pieces[0]], array('cant' => $pieces[1],'price' => $pieces[2]));
       }
        return redirect()->to('/compras')->with('message','Se ha guardado con exito')->with('alert','success');
    }

	public function show($id)
	{
        $model=Purchase::findOrFail($id);
        return view('purchase.show',compact('model'));
	}



	public function edit($id)
	{
        try{
        $user=\Auth::user();
        $providers = Provider::all()->lists('description', 'id');
        $providers = array_merge([0=>'Favor seleccione un proveedor'], $providers);
        $model=Purchase::findOrFail($id);
        return view('purchase.edit',compact('model','providers','user'));
        }catch(\Exception $e){
        return redirect()->back()->with('message','El registro no existe')
            ->with('alert','error');
    }
	}


	public function update(CreateNewPurchaseRequest $request,$id)
	{
        try{
        $user=\Auth::user();
        $invoice =  Purchase::findOrFail($id);
        $this->getInvoiceHeader($request, $user, $invoice);
        $invoice->products()->detach();
        foreach($request['result'] as $detail){
            $pieces = explode(",", $detail);
            $invoice->products()->attach([$pieces[0]], array('cant' => $pieces[1],'price' => $pieces[2]));
        }
        return redirect()->to('/compras')->with('message','Se ha guardado con exito')->with('alert','success');
        }catch(\Exception $e){
            return redirect()->back()->with('message','El registro no existe')
                ->with('alert','error');
        }
    }


	public function destroy($id)
	{
        $purchase=Purchase::findOrFail($id);
        $state=false;
        if(!$purchase->state){
            $state=true;
        }
        $purchase->state =$state;
        $purchase->save();

        return redirect()->to('compras')->with('message','Se h  a cambiado de estado con exito')->with('alert','success');
	}


    public function getProviderProduct()
    {
        $input=\Input::all();
        $provider_id=$input['id'];

        return [Product::select('id','description')->where('provider_id',$provider_id)->get(),
                Provider::find($provider_id)];
    }


    public function getProductPrice()
    {
        $input=\Input::all();
                if($product=Product::find($input['id'])){
                    return [$product->compra,$product->tax->valor,substr($product->tax->description,0,3)];
                }{
                    return '';
    }
    }


    public function getInvoiceHeader(CreateNewPurchaseRequest $request, $user, $invoice)
    {
        $input = \Input::all();
        $invoice->branch_id = $user->staff->branch_id;
        $invoice->provider_id = $request['provider_list'];
        $invoice->staff_id = $user->staff->id;
        $invoice->iva_10 = $request['iva_10'];
        $invoice->iva_5 = $request['iva_5'];
        $invoice->exent = $request['excento'];
        $invoice->total = $request['total'];
        $invoice->stamping = $request['stamping'];
        $invoice->coment = $input['coment'];
        $invoice->save();
    }

    public function getInfo()
    {
        $referencial = "Compras";
        $independiente = "Proveedores";
        return array($referencial, $independiente);
    }
}
