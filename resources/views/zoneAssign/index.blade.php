@extends('app2')
@include('partials.bread._index',['button'=>action('DistributionControllers\ZoneAssignController@create')])
@include('partials.help._ref_index')

@section('content')
        <!-- Main content -->
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
                      {!! Form:: open(['url'=>'/asignaciones/searchAssign','method'=>'POST'])!!}
                         <div class="col-md-6">
                         <div class="form-group">
                        {!! Form:: label ('staff_list','Ciudad')!!}
                        {!! Form:: select ('staff_list',$staff,null,['class'=>'form-control input-lg','id'=>'city'])!!}
                    </div>
                     </div>
                         <div class="col-md-6">
                         <div class="form-group">
                      {!! Form:: label ('actions','Acciones')!!}
                      <div class="form-actions">
                      {!!Form:: submit('Guardar',['class'=>'btn btn-success','id'=>'submit'])!!}
                      </div>
                      </div>
                     </div>
                     {!!Form::close()!!}
                     </div>
{{----}}
                   </div>
         </div>

                            @foreach(array_chunk($tables->all(),3) as $tablechunk)
                             <div class="col-md-12">
                            @foreach($tablechunk as $table)
                             <div class="col-md-4">
                                <div class="box box-widget widget-user-2">
                                  <div class="widget-user-header bg-yellow">
                                        <div class="widget-user-image">
                                             <img class="img-circle" width="65px" height="65px" src="/img/user.png" alt="User Avatar">
                                         </div>
                                         <h3 class="widget-user-username">{{$table->name}} {{$table->last_name}}</h3>
                                         <h5 class="widget-user-desc">{{$table->position->description}}</h5>
                                        </div>
                                 <div class="box-footer no-padding">
                                                                                     <ul class="nav nav-stacked">
                                                                                     @foreach($table->zones as $zonas)
                                                                                     <li><a href="#">{{$zonas->description}} <span class="pull-right badge bg-blue">{{$zonas->km}} Km</span></a></li>


                                                                                     @endforeach

                                                                                                                                                                               <li><a href="/asignaciones/{{$table->id}}/edit"> Editar <span class="pull-right badge bg-warning"><i class="fa fa-edit"></i></span></a></li>
                                                                                                                                                                               <li><a href="#" onclick="askDelete({{$table->id}})">Eliminar Asignacion <span class="pull-right badge bg-red"><i class="fa fa-trash"></i></span></a></li>

                                                                                     </ul>
                                                                                      {!! Form::open(array('id'=>'formdelete'.$table->id,'method' => 'DELETE', 'route' => array('asignaciones.destroy', $table->id))) !!}
                                                                                                                                                                             {!! Form::close() !!}
                                                                                   </div>
                                 </div>
                             </div>
                            @endforeach
                             </div>
                            @endforeach

          <div class="row" style="text-align: center">
                 {!! $tables->render() !!}
          </div>
@stop

@include('partials.help._ref_index')
@include('partials._select2')
@section('javascripts')
<script type="text/javascript">
$(document).ready(function() {
$("#city").select2();
});
 </script>
@append
@include('...partials._functionMsj')
@include('partials.msjdelete')