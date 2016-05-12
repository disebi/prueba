@extends('app2')

@section('bread')
          <h1>
            Comisiones
            <small>Reporte </small>
           </h1>

@endsection
@section('content')

 <div class="col-md-12">
         <div class="box box-widget">
                     <div class="box-header with-border">
                       <div>
                         <span class="username"><a>Buscar</a></span>
                       </div>
                       <!-- /.user-block -->
                       <div class="box-tools">
                         <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                         </button>
                       </div>
                       <!-- /.box-tools -->
                     </div>
                     <!-- /.box-header -->
                     <div style="display: block;" class="box-body">
                      {!! Form:: open(['url'=>'/comisiones','method'=>'GET'])!!}
                         <div class="col-md-4">
                         <div class="form-group">
                        {!! Form:: label ('staff_list','Empleados')!!}
                        {!! Form:: select ('staff_list',$staff, isset($salesman) ? $salesman : null,['class'=>'form-control input-lg','id'=>'staff_list'])!!}
                    </div>
                     </div>
                     <div class="col-md-4">
                                                         <!-- dates input -->
                                                         <label>Rango de Fechas</label>
                                                         <div id="reportrange" class="form-group"
                                                              style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc">
                                                             <i class="fa fa-calendar"></i>
                                                             <span></span> <b class="caret"></b>
                                                             <input name="date_start" id="date_start" type="hidden" value="{{ (isset($start) ? $start : null) }}"/>
                                                             <input name="date_end" id="date_end" type="hidden" value="{{ (isset($end) ? $end : null) }}"/>
                                                         </div>
                                                     </div>
                         <div class="col-md-4">
                         <div class="form-group">
                      {!! Form:: label ('actions','Acciones')!!}
                      <div class="form-actions">
                      {!!Form:: submit('Buscar',['class'=>'btn btn-success','id'=>'submit'])!!}
                      <input type="submit" class="btn btn-primary" value="Descargar" name="download"/>
                      </div>
                      </div>
                     </div>
                     {!!Form::close()!!}
                     </div>
{{----}}
                   </div>
         </div>

<div class="col-xs-12">
 @if(!empty($model) && isset($model))
                       <div class="box">
                         <div class="box-header">
                           <h3 class="box-title">Listas de registros de Ventas</h3>
                         </div><!-- /.box-header -->
                         <div class="box-body">

                           <table id="tablalista" class="table table-bordered table-striped">

                             <thead>
                               <tr>
                                 <th>#</th>
                                 <th>Cliente</th>
                                 <th>Zona</th>
                                 <th>Total</th>
                                 <th>% Comision</th>
                                 <th>Comision</th>
                                 <th>Usuario</th>
                                 <th>Fecha</th>
                                 <th>Acciones</th>
                               </tr>
                             </thead>
                             <tbody>
                               @foreach($model as $order)
                               <tr>
                                 <td> {{$order->id}}</td>
                                 <td>{{$order->client->description}}</td>
                                 <td>{{$order->client->zone->description}}</td>
                                 <td>{{number_format($order->total,0,'','.')}}</td>
                                 <td>{{$order->order->visits->zone->comision}}</td>
                                 <td>{{number_format($order->commission(),0,'','.')}} Gs.</td>
                                 <td>{{$order->staff->name}} {{$order->staff->last_name}}</td>
                                 <td> {{date_format($order->created_at,"d/m/Y")}}</td>
                                 <td>

                                    <a class="btn btn-default" href="/ventas/{{$order->id}}" ><i class="fa fa-search"></i> </a>
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
                          <p class="text-center"> No existen datos para mostrar</p>
                          @endif

                     </div><!-- /.col -->

@if(!empty($model) && isset($model))
<div class="col-xs-12">
                             <div class="col-md-3 col-sm-6 col-xs-12">
                               <div class="info-box">
                                 <span class="info-box-icon bg-aqua"><i class="fa fa-envelope-o"></i></span>

                                 <div class="info-box-content">
                                   <span class="info-box-text">Facturas</span>
                                   <span class="info-box-number">{{$model->count()}}</span>
                                 </div>
                                 <!-- /.info-box-content -->
                               </div>
                               <!-- /.info-box -->
                             </div>
                             <!-- /.col -->
                             <div class="col-md-3 col-sm-6 col-xs-12">
                               <div class="info-box">
                                 <span class="info-box-icon bg-green"><i class="fa fa-flag-o"></i></span>

                                 <div class="info-box-content">
                                   <span class="info-box-text">Total Venta</span>
                                   <span class="info-box-number">{{number_format($model->sum('total'),0,'','.')}}</span>
                                 </div>
                                 <!-- /.info-box-content -->
                               </div>
                               <!-- /.info-box -->
                             </div>
                             <!-- /.col -->
                             <div class="col-md-3 col-sm-6 col-xs-12">
                               <div class="info-box">
                                 <span class="info-box-icon bg-yellow"><i class="fa fa-files-o"></i></span>

                                 <div class="info-box-content">
                                   <span class="info-box-text">Total Comision</span>
                                   <span class="info-box-number">{{number_format($total_commission,0,'','.')}}</span>
                                 </div>
                                 <!-- /.info-box-content -->
                               </div>
                               <!-- /.info-box -->
                             </div>
                             <!-- /.col -->

                             <!-- /.col -->
                           </div>
 @endif
@endsection

@include('partials._range')
@include('partials._select2')
@section('javascripts')
<script type="text/javascript">
$("#staff_list").select2();
</script>
@append