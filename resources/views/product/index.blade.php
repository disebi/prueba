@extends('app2')
@include('partials.bread._index',['button'=>action('ReferentialControllers\ProductController@create')])

@section('content')
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Listas de registros de Zonas</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="table" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Descripcion</th>
                        <th>Proveedor</th>
                        <th>Linea</th>
                        <th>Presentacion</th>
                        <th>Aroma</th>
                        <th>Contenido</th>
                        <th>Medida</th>
                        <th>Compra</th>
                        <th>Venta</th>
                        <th>IVA</th>
                        <th>Acciones</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($tables as $table)
                      <tr>
                        <td> {{$table->id}}</td>
                        <td>{{$table->description}}</td>
                        <td>{{$table->provider->description}}</td>
                        <td>{{$table->line->description}}</td>
                        <td>{{$table->presentation->description}}</td>
                        <td>{{$table->aroma->description}}</td>
                        <td>{{$table->contenido}}</td>
                        <td>{{$table->unity->description}}</td>
                        <td>{{$table->compra}} Gs.</td>
                        <td>{{$table->venta}} Gs.</td>
                        <td>{{$table->tax->valor}} %</td>

                        <td>
                        {!! Form::open(array('id'=>'formdelete'.$table->id,'method' => 'DELETE', 'route' => array('productos.destroy', $table->id))) !!}
                           <a class="btn btn-default" href="/productos/{{$table->id}}/edit" ><i class="fa fa-edit"></i> </a>
                           <a class="btn btn-default" onclick="askDelete({{$table->id}})"><i class="fa fa-trash text-danger"></i></a>
                        {!! Form::close() !!}
                       </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
@stop
@include('partials.help._ref_index')
@include('partials._paginate')
@include('...partials._functionMsj')
@include('partials.msjdelete')