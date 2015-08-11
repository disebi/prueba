@extends('app2')
@section('css')
 <link href="{{ asset('/css/select2.css') }}" rel="stylesheet" type="text/css" />

@stop
           @section('content')



                <section class="content-header">
                         <h1>Nuevo Permiso<small>de Rol</small> </h1>
                   <ol class="breadcrumb">
                           <li><a href="#"><i class="fa fa-dashboard"></i> {{$independiente}}</a></li>
                           <li><a href="#">{{$referencial}}</a></li>
                  </ol>
                </section>


                   <!-- Main content -->
                <section class="content animsition">
                             <div class="row">
                               <div class="col-xs-12">
                                 <div class="box">
                                   <div class="box-header" >
                                     <h3 class="box-title">Crear un nuevo registro de Permisos</h3>
                                   </div><!-- /.box-header -->

                                           {!! Form:: open(['url'=>$url])!!}
                                               @include('license.form',['submit'=>$submit])
                                           {!!Form::close()!!}


                               </div><!-- /.col -->
                            </div><!-- /.row -->
                   </section><!-- /.content -->


           @endsection

@section('javascripts')
@include('partials.functionMsj')
@stop