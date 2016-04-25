@extends('app2')
@include('partials.bread._create')
@include('returnNote.help_create')
@section('content')
                  {!! Form:: open(['url'=>'/ajustes','id'=>'form'])!!}
                  @include('adjust.form')
                  {!! Form:: close()!!}
@endsection
@include('...partials._functionMsj')


