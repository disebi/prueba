

@extends('app2')
@include('partials.bread._index')


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
                        <th>Numero de Pedidos</th>
                        <th>Total</th>
                        <th>Vendedor</th>
                        <th>Fecha</th>
                        <th>Acciones</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($model as $order)
                      <tr>
                        <td> {{$order->id}}</td>
                        <td>{{$order->zone->description}}</td>
                        <td>{{$order->orders()->count('id')}}</td>
                        <td>{{number_format($order->orders()->sum('total'),0,',','.')}} Gs.</td>
                        <td>{{$order->zone->assign->staff->name}} {{$order->zone->assign->staff->last_name}}</td>
                        <td> {{date_format($order->created_at,"d/m/Y")}}</td>
                        <td>
                           <a class="btn btn-primary" href="/makeWorkOrder/{{$order->id}}" ><i class="fa fa-plus"></i> </a>
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
@include('...partials._functionMsj')