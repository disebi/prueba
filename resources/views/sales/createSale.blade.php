@extends('app2')
@include('partials.bread._edit')
@section('content')

                   {!! Form:: open(['url'=>'/ventas','id'=>'form'])!!}
                  @include('sales.form')
                  {!! Form:: close()!!}
@include('...partials._functionMsj')
@endsection

@section('javascripts')
@append
