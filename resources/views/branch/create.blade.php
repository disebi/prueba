@extends('app2')

           @section('bread')
                 <h1>Nueva sucursal<small>de Empresa</small> </h1>
                              <ol class="breadcrumb">
                                      <li><a href="#"><i class="fa fa-dashboard"></i> Empresa</a></li>
                                      <li><a href="#">Sucursales</a></li>
                             </ol>
           @endsection

           @section('content')
                               <div class="col-xs-12">
                                 <div class="box box-primary">
                                   <div class="box-header" >
                                     <h3 class="box-title">Crear un nuevo registro de Sucursales</h3>
                                   </div><!-- /.box-header -->
                                           {!! Form:: open(['url'=>'/sucursales'])!!}
                                               @include('branch.form',['submit'=>'Guardar'])
                                           {!!Form::close()!!}
                               </div><!-- /.col -->
                              </div>
             @endsection
             @include('partials._functionMsj')
