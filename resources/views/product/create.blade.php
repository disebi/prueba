@extends('app2')
@section('bread')
  <h1>Nuevo {{$referencial}}<small>de {{$independiente}}</small> </h1>
                  <ol class="breadcrumb">
                   <li><a href="#"><i class="fa fa-dashboard"></i>{{$independiente}}</a></li>
                   <li><a href="#">{{$referencial}}r</a></li>
                  </ol>
@endsection
@section('content')
            <div class="col-xs-12">
                <div class="box box-primary">
                                   <div class="box-header" >
                                     <h3 class="box-title">Crear un nuevo registro de Producto</h3>
                                   </div><!-- /.box-header -->
                                           {!! Form:: open(['url'=>$url])!!}
                                               @include('product.form',['submit'=>$submit])
                                           {!!Form::close()!!}
                             </div><!-- /.col -->
            </div><!-- /.col -->
@endsection
@include('partials._functionMsj')


