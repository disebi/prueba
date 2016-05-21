@extends('app2')
@include('partials.bread._edit')
@section('content')
            <div class="box">
               <div class="box-header" >
                       <h3 class="box-title">Crear un nuevo registro de {{$referencial}}</h3>
               </div><!-- /.box-header -->
                <div class="box-body">
                 {!! Form:: model($model, ['action'=>['DistributionControllers\OutController@update',$model->id],'method'=>'PATCH'])!!}
                  @include('out.form',['submit'=>'Actualizar'])
                  {!! Form:: close()!!}
                  </div>
                  </div>

@include('partials._functionMsj')
@endsection

@section('javascripts')
@append
