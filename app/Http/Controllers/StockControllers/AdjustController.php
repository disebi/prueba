<?php namespace App\Http\Controllers\StockControllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\AdjustRequest;
use App\Models\ReferentialModels\Branch;
use App\Models\ReferentialModels\Deposit;
use App\Models\ReferentialModels\Product;
use App\Models\Stock\Adjust;
use App\Models\Stock\Purchase;
use App\Services\Reports;
use App\Stock;
use Illuminate\Http\Request;

class AdjustController extends Controller {


	public function index()
	{
        $user=\Auth::user();
        $model=Adjust::orderBy('updated_at','desc')
            ->where('branch_id','=', $user->staff->branch_id)
            ->where('state','=',true)->paginate(10);
        $branches=Branch::all();
        list($referencial, $independiente) = $this->getInfo();
        return view('adjust.index',compact('model','branches','referencial','independiente'));
	}

    public function download()
    {
        $user = \Auth::user();
        $deposit_id=$user->staff->branch->deposit->id;
        $sql=\DB::table('stocks')->select('products.description','stocks.deposit_id','stocks.cant','stocks.min')
                ->join('products','stocks.product_id', '=','products.id')
                ->where('deposit_id','=',$deposit_id)->get();
        $report=new Reports();
        $report->spread($sql,'Existenci',"producto;deposito;cantidad;quiebre");

    }
	public function create()
	{
        $user=\Auth::user();
        list($referencial, $independiente) = $this->getInfo();
        $activity=['Sumar'=>'Sumar','Restar'=>'Restar'];
        $products = Product::select(\DB::raw("id, (description || ' ' || venta) as description"))->lists('description', 'id');
        return view('adjust.create',compact('referencial','independiente','user','products','activity'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store( AdjustRequest $request)
	{
        $user=\Auth::user();
        $invoice =  new Adjust();
        $this->getInvoiceHeader($request, $user, $invoice);


        foreach($request['result'] as $detail){
            $activity=0;
            $pieces = explode(",", $detail);
            if($pieces[2]=="Restar"){
                $activity=1;
            }
            $invoice->products()->attach([$pieces[0]], array('cant' => $pieces[1],'activity' => $activity));
        }
        return redirect()->to('/devoluciones')->with('message','Se ha guardado con exito')->with('alert','success');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        $model=Adjust::findOrFail($id);
        return view('adjust.show',compact('model'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        $returnNote=Adjust::findOrFail($id);
        $state=false;
        if(!$returnNote->state)
            $state=true;

        $returnNote->state =$state;
        $returnNote->save();
        return redirect()->to('compras')->with('message','Se h a cambiado de estado con exito')->with('alert','success');
	}

    public function getInfo()
    {
        $referencial = "Ajustes";
        $independiente = "Stock";
        return array($referencial, $independiente);
    }

    public function getInvoiceHeader(AdjustRequest $request, $user, $invoice)
    {
        $input = \Input::all();
        $invoice->branch_id = $user->staff->branch_id;
        $invoice->staff_id = $user->staff->id;
        $invoice->coment = $input['coment'];
        $invoice->state = true;
        $invoice->save();
    }
}
