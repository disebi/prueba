@extends('app2')


@section('bread')
       <h1>Nueva Compra<small>de Productos</small> </h1>
                   <ol class="breadcrumb">
                           <li><a href="#"><i class="fa fa-dashboard"></i>Stock</a></li>
                           <li><a href="#">Nueva Factura de Compra</a></li>
                  </ol>
@endsection
@section('content')
                  {!! Form:: open(['url'=>'/compras','id'=>'form'])!!}
                  @include('purchase.form')
                  {!! Form:: close()!!}
@endsection
@include('...partials._functionMsj')


