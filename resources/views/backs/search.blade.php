

@extends('app2')
@include('partials.bread._index')


@section('content')

              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Buscar</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                </div><!-- /.box-body -->
              </div><!-- /.box -->

        @if(!$model->isEmpty())
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Listas de registros de Salidas</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="tablalista" class="table table-bordered table-striped">

                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Conductor</th>
                        <th>Vehiculo</th>
                        <th>km</th>
                        <th>Tanque</th>
                        <th>Razon</th>
                        <th>Fecha</th>
                        <th>Acciones</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($model as $order)
                      <tr>
                        <td> {{$order->id}}</td>
                        <td>{{$order->driver->name.' '.$order->driver->last_name}}</td>
                        <td>{{$order->drive->description}}</td>
                        <td>{{$order->km}}</td>
                        <td>{{$order->tanque}}</td>
                         @if($order->razon==0)
                                                                           <td><span class="label label-warning">Otro</span></td>
                                                                          @elseif($order->razon==1)
                                                                          <td><span class="label label-success">Entrega</span></td>
                                                                          @elseif($order->razon==2)
                                                                             <td><span class="label label-info">Remision</span></td>
                                                                          @endif
                           <td> {{date_format($order->created_at,"d/m/Y")}}</td>
                        <td>
                           <a class="btn btn-primary" href="/makeBack/{{$order->id}}" ><i class="fa fa-plus"></i> </a>
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
              @else
              <p class="text-danger text-center"> No existen salidas pendientes</p>
              @endif

@stop
@include('...partials._functionMsj')