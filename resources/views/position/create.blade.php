@extends('app2')

           @include('partials.bread._create')
           @include('partials.help._ref_create')

 @section('content')
      <div class="col-xs-12">
          <div class="box box-primary">
            <div class="box-header" >
                                     <h3 class="box-title">Crear un nuevo registro de Cargos</h3>
                                   </div><!-- /.box-header -->
                {!! Form:: open(['url'=>'/cargos'])!!}
                   @include('position.form',['submit'=>'Guardar'])
                {!!Form::close()!!}
            </div><!-- /.col -->
          </div><!-- /.col -->
      </div>
@endsection
@include('partials._functionMsj')
