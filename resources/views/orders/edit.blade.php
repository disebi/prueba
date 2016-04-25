@extends('app2')
@include('partials.bread._edit')
@section('content')

                 {!! Form:: model($model, ['action'=>['DistributionControllers\OrderController@update',$model->id],'method'=>'PATCH'])!!}
                  @include('orders.form')
                  {!! Form:: close()!!}
@include('...partials._functionMsj')
@endsection

@section('javascripts')
@append
