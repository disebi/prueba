<?php namespace App\Http\Controllers\ReferentialControllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\ReferentialModels\Aroma;
use App\Models\ReferentialModels\Presentation;
use App\Models\ReferentialModels\Product;
use App\Models\ReferentialModels\Provider;
use App\Models\ReferentialModels\Tax;
use App\Models\ReferentialModels\Unity;
use App\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Models\ReferentialModels\Line;

class ProductController extends Controller {
    public function __construct()
    {
        $this->permission = \Auth::user()->hasAccess('product.all');
    }
    public function index()
    {
        if(!$this->permission)
            return redirect()->back()->with('message','No tiene los permisos asignados para acceder')->with('alert','error');

        $tables=Product::all();
        $url='productos';
        list($referencial, $independiente, $controlador) = $this->sendInfo();
        return view ('product.index',compact('url','tables','referencial','independiente','controlador'));
    }

    public function create()
    {
        if(!$this->permission)
            return redirect()->back()->with('message','No tiene los permisos asignados para acceder')->with('alert','error');

        list($referencial, $independiente, $controlador) = $this->sendInfo();
        $url='productos';
        $submit='Guardar';
        list($taxes, $providers, $unities, $presentations, $lines, $aromas) = $this->getSelectBox();
        $edit=0;
        return view ('product.create',compact('edit','url','referencial','independiente',
                                                  'controlador','submit','taxes','providers',
                                            'unities','presentations','lines','aromas'));

    }


    public function store(Requests\CreateProductRequest $request)
    {
        if(!$this->permission)
            return redirect()->back()->with('message','No tiene los permisos asignados para acceder')->with('alert','error');

        $obj=$request->all();
        $obj = $this->setObjectToSave($obj);
        Product::create($obj);
        return redirect()->to('/productos')->with('message','Su producto se ha creado con exito')->with('alert','success');
    }



    public function edit($id)
    {
        if(!$this->permission)
            return redirect()->back()->with('message','No tiene los permisos asignados para acceder')->with('alert','error');

        try{
        $submit='Guardar Cambios';
        $model = Product::findOrFail($id);
        $url='productos';
        $action='ReferentialControllers\ProductController@update';
        list($referencial, $independiente, $controlador) = $this->sendInfo();
        list($taxes, $providers, $unities, $presentations, $lines, $aromas) = $this->getSelectBox();
        $edit=0;
        return view ('product.edit',compact('edit','url','referencial','independiente',
            'controlador','submit','taxes','providers',
            'unities','presentations','lines','aromas','model','action'));
        }catch(\Exception $e){
            return redirect()->back()->with('message','El registro no existe')
                ->with('alert','error');
        }
    }


    public function update($id,Requests\CreateProductRequest $request)
    {
        if(!$this->permission)
            return redirect()->back()->with('message','No tiene los permisos asignados para acceder')->with('alert','error');

        try{
        $model = Product::findOrFail($id);
        $obj=$request->all();
        $obj = $this->setObjectToSave($obj);
        $model->update($obj);
        $params = ['message'=>'Se ha guardado con exito',
            'alert'=>'success'];
        return redirect()->to('/productos')->with($params);
        }catch(\Exception $e){
            return redirect()->back()->with('message','El registro no existe')
                ->with('alert','error');
        }
    }

    public function destroy($id)
    {
        if(!$this->permission)
            return redirect()->back()->with('message','No tiene los permisos asignados para acceder')->with('alert','error');

        try{
            Product::destroy($id);
            return redirect()->back()->with('message', 'El registro se ha eliminado con exito')
                ->with('alert', 'success');
        }catch(QueryException $e){
            return redirect()->back()->with('message', 'El registro no ha podido ser eliminado, esta siendo utilizado actualmente')
                ->with('alert', 'error');
        }
    }

    public function sendInfo()
    {
        $referencial = 'Productos';
        $independiente = 'Stock';
        $controlador = '\Product';
        return array($referencial, $independiente, $controlador);
    }


    public function getSelectBox()
    {
        $taxes = Tax::all()->lists('valor', 'id');
        $providers = Provider::all()->lists('description', 'id');
        $unities = Unity::all()->lists('description', 'id');
        $presentations = Presentation::all()->lists('description', 'id');
        $lines = Line::all()->lists('description', 'id');
        $aromas = Aroma::all()->lists('description', 'id');
        return array($taxes, $providers, $unities, $presentations, $lines, $aromas);
    }

    public function setObjectToSave($obj)
    {
        $obj['aroma_id'] = $obj['aroma_list'];
        unset($obj['aroma_list']);
        $obj['unity_id'] = $obj['unity_list'];
        unset($obj['unity_list']);
        $obj['presentation_id'] = $obj['presentation_list'];
        unset($obj['presentation_list']);
        $obj['provider_id'] = $obj['provider_list'];
        unset($obj['provider_list']);
        $obj['tax_id'] = $obj['tax_list'];
        unset($obj['tax_list']);
        $obj['line_id'] = $obj['line_list'];
        unset($obj['line_list']);
        return $obj;
    }
}
