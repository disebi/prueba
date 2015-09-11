<?php namespace App\Http\Controllers\ReferentialControllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\ReferentialModels\Product;
use Illuminate\Http\Request;

class ProductController extends Controller {
    public function index()
    {
        $tables=Product::all();
        $url='productos';
        list($referencial, $independiente, $controlador) = $this->sendInfo();
        return view ('product.index',compact('url','tables','referencial','independiente','controlador'));

    }


    public function create()
    {
        list($referencial, $independiente, $controlador) = $this->sendInfo();
        $url='zonas';
        $submit='Guardar';
        $cities=City::all()->lists('description','id');
        $edit=0;
        return view ('zone.create',compact('edit','url','referencial','independiente','controlador','submit','cities'));

    }


    public function store(Requests\CreateProductRequest $request)
    {
        $obj=$request->all();
        $obj['city_id'] = $obj['city_list'];
        unset($obj['city_list']);
        Product::create($obj);
        return redirect()->to('/zonas')->with('message','Su zona se ha creado con exito')->with('alert','success');
    }



    public function edit($id)
    {
        $submit='Guardar Cambios';
        $model = Product::findOrFail($id);
        $url='zonas';
        $action='ReferentialControllers\ProductController@update';
        list($referencial, $independiente, $controlador) = $this->sendInfo();
        $cities=City::all()->lists('description','id');
        return view ('zone.edit',compact('cities','action','url','model','submit','referencial','independiente'));

    }


    public function update($id,Requests\CreateProductRequest $request)
    {
        $model = Product::find($id);
        $obj=$request->all();
        $obj['city_id'] = $obj['city_list'];
        unset($obj['city_list']);
        $model->update($obj);
        $params = ['message'=>'Se ha guardado con exito',
            'alert'=>'success'];
        return redirect()->to('/zonas')->with($params);
    }

    public function destroy($id)
    {
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

    public function storeModal(Requests\CreateProductRequest $request)
    {
        $input=$request->all();
        unset($input['_token']);
        Product::create($input);
        $html=Product::select('id','description')->get();
        return $html;
    }
}
