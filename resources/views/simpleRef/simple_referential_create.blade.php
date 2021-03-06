@extends('app2')

           @section('bread')
                    <h1>Nuevo {{$referencial}}<small>de {{$independiente}}</small> </h1>
                              <ol class="breadcrumb">
                                      <li><a href="#"><i class="fa fa-dashboard"></i> {{$independiente}}</a></li>
                                      <li><a href="#">{{$referencial}}</a></li>
                    </ol>
           @endsection

           @section('content')

                                 <div class="box">
                                   <div class="box-header" >
                                     <h3 class="box-title">Crear un nuevo registro de {{$referencial}}</h3>
                                   </div><!-- /.box-header -->

                                           {!! Form:: open(['url'=>$url])!!}
                                               @include('simpleRef.simple_referential_form',['submit'=>$submit])
                                           {!!Form::close()!!}
                                 </div><!-- /.col -->

           @endsection
           @section('javascripts')
                @include('...partials._functionMsj')
           @stop