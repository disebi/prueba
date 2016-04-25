@extends('app2')

@include('partials.bread._create')
@include('partials.help._ref_create',['help'=>['plus']])
@section('content')
      <div class="col-xs-12">
                                 <div class="box box-primary">
                                   <div class="box-header" >
                                     <h3 class="box-title">Crear un nuevo registro de Vehiculo</h3>
                                   </div><!-- /.box-header -->
                                           {!! Form:: open(['url'=>'/vehiculos'])!!}
                                               @include('drive.form',['submit'=>'Guardar'])
                                           {!!Form::close()!!}
                             </div><!-- /.col -->
                               </div><!-- /.col -->
       @include('...partials._functionMsj')
@endsection


