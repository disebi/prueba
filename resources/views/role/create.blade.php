@extends('app2')



@section('content')
                <section class="content-header">
                         <h1>Nuevo {{$referencial}}<small>de {{$independiente}}</small> </h1>
                   <ol class="breadcrumb">
                           <li><a href="#"><i class="fa fa-dashboard"></i>{{$independiente}}</a></li>
                           <li><a href="#">{{$referencial}}r</a></li>
                  </ol>
                </section>
                   <!-- Main content -->
                <section class="content animsition">
                             <div class="row">
                               <div class="col-xs-12">
                                 <div class="box box-primary">
                                   <div class="box-header" >
                                     <h3 class="box-title">Crear un nuevo registro de Zona</h3>
                                   </div><!-- /.box-header -->
                                           {!! Form:: open(['url'=>'/roles'])!!}
                                               @include('role.form')
                                           {!!Form::close()!!}
                             </div><!-- /.col -->
                               </div><!-- /.col -->
                            </div><!-- /.row -->
                   </section><!-- /.content -->
@include('partials.functionMsj')
@endsection



