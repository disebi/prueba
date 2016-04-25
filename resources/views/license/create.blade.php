@extends('app2')
           @include('partials.bread._create')
           @include('partials.help._ref_create')
@section('content')
    <div class="col-xs-12">
         <div class="box">
             <div class="box-header" >
                 <h3 class="box-title">Crear un nuevo registro de Permisos</h3>
                  </div><!-- /.box-header -->
                {!! Form:: open(['url'=>$url])!!}
                    @include('license.form',['submit'=>$submit])
                {!!Form::close()!!}
         </div><!-- /.col -->
    </div><!-- /.row -->
@endsection
@include('partials._functionMsj')

