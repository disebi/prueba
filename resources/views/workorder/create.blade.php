@extends('app2')
           @include('partials.bread._create')
           @include('partials.help._ref_create')
@section('content')
     <div class="col-xs-12">
                                 <div class="box box-primary">
                                   <div class="box-header" >
                                     <h3 class="box-title">Crear nuevas Ordenes de Trabajo</h3>
                                   </div>
                                   <div class="box-body" >
                                     </div><!-- /.col -->
                             </div><!-- /.col -->
                               </div><!-- /.col -->

                               <div class="col-xs-12">
                                   {!! Form:: open(['url'=>'/ordenTrabajo'])!!}
                                        @include('workorder.form')
                                     {!!Form::close()!!}
                               </div>
@endsection
@include('partials._functionMsj')


