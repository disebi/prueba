@extends('app2')
@include('partials.bread._create')
@include('returnNote.help_create')
@section('content')
                  {!! Form:: open(['url'=>'/devoluciones','id'=>'form'])!!}
                  @include('returnNote.form')
                  {!! Form:: close()!!}
@endsection
@include('...partials._functionMsj')


