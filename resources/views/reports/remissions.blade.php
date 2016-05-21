@extends('app2')

@section('bread')
          <h1>
            Remisiones
            <small>Reporte </small>
           </h1>

@endsection
@section('content')

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
                      {!! Form:: open(['url'=>'/reporte_remisiones','method'=>'GET'])!!}

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
                                            {!! Form:: label ('branch_list','Sucursal')!!}
                                            {!! Form:: select ('branch_list',$branches, isset($branch) ? $branch : null,['class'=>'form-control input-lg','id'=>'branch_list'])!!}
                                        </div>
                     </div>

                     <div class="col-md-4">
                                         <div class="form-group">
                                                                 {!! Form:: label ('state','Estado')!!}
                                                                 {!! Form:: select ('state',$states, isset($state) ? $state : null,['class'=>'form-control input-lg','id'=>'state_list'])!!}
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

           @if(!empty($model) && isset($model))
                       <div class="box">
                         <div class="box-header">
                           <h3 class="box-title">Listas de Ordenes</h3>
                         </div><!-- /.box-header -->
                         <div class="box-body">

                           <table id="tablalista" class="table table-bordered table-striped">

                             <thead>
                               <tr>
                                    <th>Responsable</th>
                                    <th>Supervisor Destino</th>
                                    <th class="text-center">Sucursal Origen</th>
                                    <th class="text-center">Sucursal Destino</th>
                                    <th class="text-center">Proceso</th>
                                    <th class="text-center">Fecha</th>
                                    <th class="text-center">Acciones</th>
                               </tr>
                             </thead>
                             <tbody>
                               @foreach($model as $order)
                               <tr>
                                 <td> {{$order->name.' '.$order->last_name}}</td>
                                 <td> {{$order->nameto.' '.$order->last_nameto}}</td>
                                 <td class="text-center"> {{$order->branch}}</td>
                                 <td class="text-center"> {{$order->branchto}}</td>
                                 <td class="text-center">
                                 @if($order->process == 0)
                                 <label class="label label-warning">En espera</label>
                                 @elseif($order->process == 1)
                                 <label class="label label-warning">Enviados</label>
                                 @elseif($order->process ==2)
                                   <label class="label label-primary">Aceptados</label>
                                  @elseif($order->process ==3)
                                   <label class="label label-success">Concluidos</label>
                                   @endif
                                   </td>
                                   <td class="text-center"> {{$order->created_at}}</td>
                                 <td class="text-center"><a href="/remisiones/{{$order->id}}" class="btn btn-default"><i class="fa fa-search"></i></a></td>
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
                                                <p class="text-center">No existen datos para mostrar</p>
                                                @endif

@endsection

@include('partials._range')
@include('partials._select2')
@section('javascripts')
<script type="text/javascript">
$("#staff_list").select2();
$("#branch_list").select2();
$("#state_list").select2();
</script>
@append