@extends('app2')
@include('partials.bread._edit')
@section('content')

                   {!! Form:: open(['url'=>'/credito','id'=>'form'])!!}
                  @include('credit.form')
                  {!! Form:: close()!!}
@include('...partials._functionMsj')
@endsection

@section('javascripts')
@append
