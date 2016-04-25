@extends('app2')

           @include('partials.bread._create')
           @include('partials.help._ref_create',['help'=>['plus']])
@section('content')
   <div class="col-xs-12">
                                 <div class="box box-primary">
                                   <div class="box-header" >
                                     <h3 class="box-title">Crear un nuevo registro de {{$referencial}}</h3>
                                   </div><!-- /.box-header -->

                                           {!! Form:: open(['url'=>'/clientes'])!!}

                                               @include('local.form',['submit'=>'Guardar'])

                                           {!!Form::close()!!}

                                </div>
                               </div><!-- /.col -->
@endsection

@include('partials._functionMsj')

