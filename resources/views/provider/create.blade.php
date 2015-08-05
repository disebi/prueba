@extends('app2')

           @section('content')



                <section class="content-header">
                         <h1>Nuevo proveedor<small>de productos</small> </h1>
                   <ol class="breadcrumb">
                           <li><a href="#"><i class="fa fa-dashboard"></i> Productos</a></li>
                           <li><a href="#">Proveedor</a></li>
                  </ol>
                </section>


                   <!-- Main content -->
                <section class="content animsition">
                             <div class="row">
                               <div class="col-xs-12">
                                 <div class="box box-primary">
                                   <div class="box-header" >
                                     <h3 class="box-title">Crear un nuevo registro de Proveedor</h3>
                                   </div><!-- /.box-header -->

                                           {!! Form:: open(['url'=>'/proveedores'])!!}
                                               @include('provider.form',['submit'=>'Guardar'])
                                           {!!Form::close()!!}


                               </div><!-- /.col -->
                            </div><!-- /.row -->
                   </section><!-- /.content -->


           @endsection

@section('javascripts')
@include('partials.msj')
@stop