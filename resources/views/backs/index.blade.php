

@extends('app2')
@include('partials.bread._index',['button'=>action('DistributionControllers\BackController@search')])



@section('content')
  <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Buscar</h3>
                </div>
                <div class="box-body">
                </div>
              </div>
            </div>
  <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Listas de registros de Entradas</h3>
                </div>
                <div class="box-body">
                  <table id="tablalista" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Conductor</th>
                        <th>Vehiculo</th>
                        <th>Supervisor</th>

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
                         <td>{{$order->staff->name}} {{$order->staff->last_name}}</td>
                        <td> {{date_format($order->created_at,"d/m/Y")}}</td>
                        <td>
                         {!! Form::open(array('id'=>'formdelete'.$order->id,'method' => 'DELETE', 'route' => array('entradas.destroy', $order->id))) !!}
                         {!! Form::close() !!}
                           <a class="btn btn-default" href="/entradas/{{$order->id}}" ><i class="fa fa-search"></i> </a>
                           <a class="btn btn-default" href="/entradas/{{$order->id}}/edit" ><i class="fa fa-edit"></i> </a>
                           {{--<button onclick='return btnClick();' type="submit" class="btn btn-default" title="Eliminar"><i class="fa fa-trash text-danger"></i></button>{!! Form::close() !!}--}}
                           <a class="btn btn-default" onclick="askDelete({{$order->id}})"><i class="fa fa-trash text-danger"></i></a>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
                    <div class="row" style="text-align: center">
                  {!! $model->render() !!}
                    </div>
              </div>
            </div>
@stop
@include('partials.help._ref_index')
@include('partials.msjdelete')
@include('...partials._functionMsj')