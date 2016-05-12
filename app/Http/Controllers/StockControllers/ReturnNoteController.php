<?php namespace App\Http\Controllers\StockControllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateNewPurchaseRequest;
use App\Http\Requests\CreateReturnRequest;
use App\Models\ReferentialModels\Branch;
use App\Models\ReferentialModels\Client;
use App\Models\ReferentialModels\Product;
use App\Models\Stock\ReturnNote;
use Illuminate\Http\Request;


class ReturnNoteController extends Controller {

    public function __construct()
    {
        $this->permission = \Auth::user()->hasAccess('return.all');
    }

	public function index()
	{
        if(!$this->permission)
        return redirect()->back()->with('message','No tiene los permisos asignados para acceder')->with('alert','error');

        $user=\Auth::user();
        $model=ReturnNote::orderBy('updated_at','desc')
            ->where('branch_id','=', $user->staff->branch_id)
            ->where('state','=',true)->paginate(10);
		$branches=Branch::all();
        list($referencial, $independiente) = $this->getInfo();
        return view('returnNote.index',compact('model','branches','referencial','independiente'));
	}

	public function create()
	{
        if(!$this->permission)
            return redirect()->back()->with('message','No tiene los permisos asignados para acceder')->with('alert','error');

        $user=\Auth::user();
        $clients = Client::all()->lists('description', 'id');
        list($referencial, $independiente) = $this->getInfo();
        $clients[0] = 'Favor seleccione un cliente';
        asort($clients);
        $products = Product::select(\DB::raw("id, (description || ' ' || venta) as description"))->lists('description', 'id');
        return view('returnNote.create',compact('clients','referencial','independiente','user','products'));
	}


	public function store(CreateReturnRequest $request)
	{
        if(!$this->permission)
            return redirect()->back()->with('message','No tiene los permisos asignados para acceder')->with('alert','error');

        $user=\Auth::user();
       $invoice =  new ReturnNote();
       $this->getInvoiceHeader($request, $user, $invoice);
       foreach($request['result'] as $detail){
        $pieces = explode(",", $detail);

        $invoice->products()->attach([$pieces[0]], array('cant' => $pieces[1]));
       }
        return redirect()->to('/devoluciones')->with('message','Se ha guardado con exito')->with('alert','success');

    }

	public function show($id)
	{
        if(!$this->permission)
            return redirect()->back()->with('message','No tiene los permisos asignados para acceder')->with('alert','error');

        $model=ReturnNote::findOrFail($id);
        return view('returnNote.show',compact('model'));
	}



	public function edit($id)
	{

	}


	public function update(CreateNewPurchaseRequest $request,$id)
	{

    }


	public function destroy($id)
	{
        if(!$this->permission)
            return redirect()->back()->with('message','No tiene los permisos asignados para acceder')->with('alert','error');

        $returnNote=ReturnNote::findOrFail($id);
        $state=false;
        if(!$returnNote->state)
            $state=true;

        $returnNote->state =$state;
        $returnNote->save();
        return redirect()->to('compras')->with('message','Se h a cambiado de estado con exito')->with('alert','success');
	}


    public function getClient()
    {
        $input=\Input::all();
        $client_id=$input['id'];
        return Client::find($client_id);
    }


    public function getInvoiceHeader(CreateReturnRequest $request, $user, $invoice)
    {
        $input = \Input::all();
        $invoice->branch_id = $user->staff->branch_id;
        $invoice->client_id = $request['client_list'];
        $invoice->staff_id = $user->staff->id;
        $invoice->coment = $input['coment'];
        $invoice->save();
    }


    public function getInfo()
    {
        $referencial = "Devoluciones";
        $independiente = "Cliente";
        return array($referencial, $independiente);
    }


}
