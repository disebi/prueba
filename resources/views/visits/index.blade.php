

@extends('app2')
@include('partials.bread._index',['button'=>action('DistributionControllers\VisitController@create')])



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
                        <th>Zona</th>
                        <th>Dia de Delivery</th>
                        <th>Total</th>
                        <th>Nro Pedidos</th>
                        <th>Vendedor</th>
                        <th>Fecha</th>
                        <th>Acciones</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($model as $visit)
                      <tr>
                        <td> {{$visit->id}}</td>
                        <td>{{$visit->zone->description}}</td>
                        <td>{{$visit->delivery_date}}</td>
                        <td class="text-right">{{number_format($visit->orders()->active()->sum('total'),0,'','.')}} Gs.</td>
                        <td class="text-right">{{number_format($visit->orders()->active()->count(),0,'','.')}} </td>
                        <td>{{$visit->staff->name}} {{$visit->staff->last_name}}</td>
                        <td> {{date_format($visit->created_at,"d/m/Y")}}</td>
                        <td>
                         {!! Form::open(array('id'=>'formdelete'.$visit->id,'method' => 'DELETE', 'route' => array('visitas.destroy', $visit->id))) !!}
                         {!! Form::close() !!}

                           <a class="btn btn-default" href="/visitas/{{$visit->id}}" ><i class="fa fa-search"></i> </a>
                           {{--<a class="btn btn-default" href="/visitas/{{$visit->id}}/edit" ><i class="fa fa-edit"></i> </a>--}}
                           {{--<button onclick='return btnClick();' type="submit" class="btn btn-default" title="Eliminar"><i class="fa fa-trash text-danger"></i></button>{!! Form::close() !!}--}}
                            <a class="btn btn-default" onclick="askDelete({{$visit->id}})"><i class="fa fa-trash text-danger"></i></a>
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