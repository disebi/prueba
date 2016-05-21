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
            ->branch()
            ->pendent()
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

        $back=Back::findOrFail($id);
        return view('backs.show',compact('back'));
    }


    public function edit($id)
    {
        if(!$this->permission)
            return redirect()->back()->with('message','No tiene los permisos asignados para acceder')->with('alert','error');
        try{
            $user=\Auth::user();
            $model=Back::find($id);
            $out=Out::find($model->out_id);
            list($referencial, $independiente) = $this->getInfo();
            return view('backs.edit',compact('model','out','clients','products','user','referencial','independiente'));
        }catch(\Exception $e){
            return redirect()->back()->with('message','El registro no existe')
                ->with('alert','error');
        }
    }

    public function update(Requests\BackRequest $request,$id)
    {
        if(!$this->permission)
            return redirect()->back()->with('message','No tiene los permisos asignados para acceder')->with('alert','error');
        try{
            $user=\Auth::user();
            $invoice =  Back::find($id);
            $this->getInvoiceHeader($request, $user, $invoice);
            return redirect()->to('/entradas')->with('message','Se ha guardado con exito')->with('alert','success');
        }catch(\Exception $e){
            return redirect()->back()->with('message','El registro no existe')
                ->with('alert','error');
        }
    }


    public function destroy($id)
    {
        if(!$this->permission)
            return redirect()->back()->with('message','No tiene los permisos asignados para acceder')->with('alert','error');

        $back=Back::findOrFail($id);
        $state=false;
        if(!$back->state){
            $state=true;
        }
        $back->state =$state;
        $back->save();
        if(!$back->sate){
           $out = Out::find($back->out_id);
            $out->process = 0;
            $out->save();
        }
        return redirect()->to('entradas')->with('message','Se h  a cambiado de estado con exito')->with('alert','success');
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
        $out = Out::find($request['out_id']);
        $out->process = 1;
        $out->save();
    }

    public function getInfo()
    {
        $referencial = "Entrada";
        $independiente = "Vehiculos";
        return array($referencial, $independiente);
    }



}
