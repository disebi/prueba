

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
                  <h3 class="box-title">Listas de registros de Ordenes A facturar</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="tablalista" class="table table-bordered table-striped">

                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Zona</th>
                        <th>Descripcion</th>
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
                        <td>{{$order->client->zone->description}}</td>
                        <td>{{$order->client->description}}</td>
                        <td>{{number_format($order->total,0,',','.')}}</td>

                        <td>{{$order->staff->name}} {{$order->staff->last_name}}</td>
                        <td> {{date_format($order->created_at,"d/m/Y")}}</td>
                        <td>
                           <a class="btn btn-primary" href="/makeSale/{{$order->id}}" ><i class="fa fa-plus"></i> </a>
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