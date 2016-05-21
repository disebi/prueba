
@extends('app2')
@include('partials.bread._index',['button'=>action('DistributionControllers\OutController@create')])

@section('content')

              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Buscar</h3>
                </div>
                <div class="box-body">
                </div>
              </div>

              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Listas de registros de Salidas</h3>
                </div>
                <div class="box-body">
               @if(!$model->isEmpty())
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
                         {!! Form::open(array('id'=>'formdelete'.$order->id,'method' => 'DELETE', 'route' => array('salidas.destroy', $order->id))) !!}
                         {!! Form::close() !!}
                           <a class="btn btn-default" href="/salidas/{{$order->id}}" ><i class="fa fa-search"></i> </a>
                           <a class="btn btn-default" href="/salidas/{{$order->id}}/edit" ><i class="fa fa-edit"></i> </a>
                           {{--<button onclick='return btnClick();' type="submit" class="btn btn-default" title="Eliminar"><i class="fa fa-trash text-danger"></i></button>{!! Form::close() !!}--}}
                           <a class="btn btn-default" onclick="askDelete({{$order->id}})"><i class="fa fa-trash text-danger"></i></a>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                <div class="row" style="text-align: center">
                                 {!! $model->render() !!}
                                   </div>
                </div>
                @else
                   <p class="text-danger text-center"> No existen registros</p>
                @endif
              </div>

@stop
@include('partials.help._ref_index')
@include('partials.msjdelete')
@include('partials._functionMsj')