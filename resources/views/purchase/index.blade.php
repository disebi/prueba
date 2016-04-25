

@extends('app2')
@include('partials.bread._index',['button'=>action('StockControllers\PurchaseController@create')])


@section('content')
  <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Buscar</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
  <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Listas de registros de Compras</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="tablalista" class="table table-bordered table-striped">

                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Descripcion</th>
                        <th>Total</th>
                        <th>Usuario</th>
                        <th>Fecha</th>
                        <th>Acciones</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($model as $order)
                      <tr>
                        <td> {{$order->id}}</td>
                        <td>{{$order->provider->description}}</td>
                        <td>{{number_format($order->total,0,'','.')}}</td>
                        <td>{{$order->staff->name}} {{$order->staff->last_name}}</td>
                        <td> {{date_format($order->created_at,"d/m/Y")}}</td>
                        <td>
                         {!! Form::open(array('id'=>'formdelete'.$order->id,'method' => 'DELETE', 'route' => array('compras.destroy', $order->id))) !!}
                         {!! Form::close() !!}

                           <a class="btn btn-default" href="/compras/{{$order->id}}" ><i class="fa fa-search"></i> </a>
                           {{--<a class="btn btn-default" href="/compras/{{$order->id}}/edit" ><i class="fa fa-edit"></i> </a>--}}
                           {{--<button onclick='return btnClick();' type="submit" class="btn btn-default" title="Eliminar"><i class="fa fa-trash text-danger"></i></button>{!! Form::close() !!}--}}
                            <a class="btn btn-default" onclick="askDelete({{$order->id}})"><i class="fa fa-trash text-danger"></i></a>
                        </td>
                      </tr>
                      @endforeach

                    </tbody>

                  </table>
                </div><!-- /.box-body -->
                    <div class="row" style="text-align: center">
                  {!! $model->render() !!}
                    </div>
              </div><!-- /.box -->


            </div><!-- /.col -->
@stop
@include('partials.help._ref_index')
@include('partials.msjdelete')
@include('...partials._functionMsj')