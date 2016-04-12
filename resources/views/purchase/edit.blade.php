@extends('app2')
@section('bread')
        <h1>Nueva Compra<small>de Productos</small> </h1>
                   <ol class="breadcrumb">
                           <li><a href="#"><i class="fa fa-dashboard"></i>Stock</a></li>
                           <li><a href="#">Nueva Factura de Compra</a></li>
                  </ol>
@endsection
@section('content')

                 {!! Form:: model($model, ['action'=>['StockControllers\PurchaseController@update',$model->id],'method'=>'PATCH'])!!}
                  @include('purchase.form')
                  {!! Form:: close()!!}
@include('...partials._functionMsj')
@endsection

@section('javascripts')
@append
