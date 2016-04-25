@extends('app2')
           @include('partials.bread._create')
           @include('partials.help._ref_create')
@section('content')
     <div class="col-xs-12">
                                 <div class="box box-primary">
                                   <div class="box-header" >
                                     <h3 class="box-title">Crear un nuevo registro de Zona</h3>
                                   </div><!-- /.box-header -->
                                           {!! Form:: open(['url'=>'/roles'])!!}
                                               @include('role.form')
                                           {!!Form::close()!!}
                             </div><!-- /.col -->
                               </div><!-- /.col -->
@endsection
@include('partials._functionMsj')


