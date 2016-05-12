@extends('app2')


@include('partials.bread._create')
@include('purchase.help_create')

@section('content')
                <div class="box">
                   <div class="box-header" >
                                     <h3 class="box-title">Crear un nuevo registro de {{$referencial}}</h3>
                  </div><!-- /.box-header -->
                  <div class="box-body">
                          {!! Form:: open(['url'=>'/entradas','id'=>'form'])!!}
                          @include('backs.form',['submit'=>'Guardar'])
                          {!! Form:: close()!!}
                  </div>
                </div>

@endsection
@include('...partials._functionMsj')


