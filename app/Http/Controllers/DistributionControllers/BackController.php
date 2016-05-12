<?php namespace App\Http\Controllers\DistributionControllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Distribution\Back;
use App\Models\Distribution\Out;
use Illuminate\Http\Request;

class BackController extends Controller {

    public function __construct()
    {
        $this->permission = \Auth::user()->hasAccess('back.all');
    }

    public function index()
    {
        if(!$this->permission)
            return redirect()->back()->with('message','No tiene los permisos asignados para acceder')->with('alert','error');

        $user=\Auth::user();
        $model=Back::orderBy('updated_at','desc')->active()->branch()->paginate(10);
        list($referencial, $independiente) = $this->getInfo();
        return view('backs.index',compact('model','branches','referencial','independiente'));
    }


    public function search()
    {
        if(!$this->permission)
            return redirect()->back()->with('message','No tiene los permisos asignados para acceder')->with('alert','error');
        $user=\Auth::user();
        $model=Out::orderBy('updated_at','desc')
            ->where('branch_id','=',$user->staff->branch_id)
            ->where('state','=',true)->paginate(10);
         list($referencial, $independiente) = $this->getInfo();
        return view('backs.search',compact('model','referencial','independiente'));
    }

    public function create()
    {
        if(!$this->permission)
            return redirect()->back()->with('message','No tiene los permisos asignados para acceder')->with('alert','error');

        return redirect()->to('ordenes/visitas');
    }

    public function makeBack($id)
    {
        if(!$this->permission)
            return redirect()->back()->with('message','No tiene los permisos asignados para acceder')->with('alert','error');
        $user=\Auth::user();
        $out=Out::find($id);
        list($referencial, $independiente) = $this->getInfo();
        return view('backs.create',compact('out','user','referencial','independiente'));
    }
    public function store(Requests\BackRequest $request)
    {
        if(!$this->permission)
            return redirect()->back()->with('message','No tiene los permisos asignados para acceder')->with('alert','error');
        $user=\Auth::user();
        $invoice =  new Back();
        $this->getInvoiceHeader($request, $user, $invoice);
        return redirect()->to('/entradas')->with('message','Se ha guardado con exito')->with('alert','success');
    }


    public function show($id)
    {
        if(!$this->permission)
            return redirect()->back()->with('message','No tiene los permisos asignados para acceder')->with('alert','error');

        $model=Order::findOrFail($id);
        return view('orders.show',compact('model'));
    }


    public function edit($id)
    {
        if(!$this->permission)
            return redirect()->back()->with('message','No tiene los permisos asignados para acceder')->with('alert','error');

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
        if(!$this->permission)
            return redirect()->back()->with('message','No tiene los permisos asignados para acceder')->with('alert','error');

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
        if(!$this->permission)
            return redirect()->back()->with('message','No tiene los permisos asignados para acceder')->with('alert','error');

        $purchase=Order::findOrFail($id);
        $state=false;
        if(!$purchase->state){
            $state=true;
        }
        $purchase->state =$state;
        $purchase->save();
        return redirect()->to('ordenes')->with('message','Se h  a cambiado de estado con exito')->with('alert','success');
    }

    public function getInvoiceHeader(Requests\BackRequest $request, $user, $invoice)
    {
        $input = \Input::all();
        $invoice->out_id = $request['out_id'];
        $invoice->tanque = $request['tanque'];
        $invoice->km = $input['km'];
        $invoice->branch_id = $user->staff->branch_id;
        $invoice->staff_id = $user->staff->id;
        $invoice->state = true;
        $invoice->comments = $input['comments'];
        $invoice->save();
    }

    public function getInfo()
    {
        $referencial = "Entrada";
        $independiente = "Vehiculos";
        return array($referencial, $independiente);
    }



}
