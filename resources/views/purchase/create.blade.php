@extends('app2')


@include('partials.bread._create')
@include('purchase.help_create')

@section('content')
                  {!! Form:: open(['url'=>'/compras','id'=>'form'])!!}
                  @include('purchase.form')
                  {!! Form:: close()!!}
@endsection
@include('...partials._functionMsj')


