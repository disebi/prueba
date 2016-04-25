@extends('app2')

           @include('partials.bread._create')
           @include('partials.help._ref_create')
           @section('content')
             <div class="col-xs-12">
                <div class="box box-primary">
                                   <div class="box-header" >
                                     <h3 class="box-title">Crear un nuevo registro de Proveedor</h3>
                                   </div><!-- /.box-header -->

                                           {!! Form:: open(['url'=>'/proveedores'])!!}
                                               @include('provider.form',['submit'=>'Guardar'])
                                           {!!Form::close()!!}
                   </div><!-- /.col -->
             </div><!-- /.col -->
           @endsection
@section('javascripts')
@include('...partials._functionMsj')
@stop