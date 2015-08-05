@extends('app2')

           @section('content')



                <section class="content-header">
                         <h1>Nuevo cargo<small>de Empleados</small> </h1>
                   <ol class="breadcrumb">
                           <li><a href="#"><i class="fa fa-dashboard"></i> Empleados</a></li>
                           <li><a href="#">Cargos</a></li>
                  </ol>
                </section>


                   <!-- Main content -->
                <section class="content">
                             <div class="row">
                               <div class="col-xs-12">
                                 <div class="box box-primary">
                                   <div class="box-header" >
                                     <h3 class="box-title">Crear un nuevo registro de Cargos</h3>
                                   </div><!-- /.box-header -->

                                           {!! Form:: open(['url'=>'/cargos'])!!}
                                               @include('position.form',['submit'=>'Guardar'])
                                           {!!Form::close()!!}


                               </div><!-- /.col -->
                              </div>
                            </div><!-- /.row -->
               </section><!-- /.content -->
           @endsection

@section('javascripts')
@include('partials.msj')
@stop