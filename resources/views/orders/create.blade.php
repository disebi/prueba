@extends('app2')


@include('partials.bread._create')
@include('purchase.help_create')

@section('content')
                  {!! Form:: open(['url'=>'/ordenes','id'=>'form'])!!}
                  @include('orders.form')
                  {!! Form:: close()!!}
@endsection
@include('...partials._functionMsj')


