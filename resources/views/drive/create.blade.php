@extends('app2')


@section('css')
 <link href="{{ asset('/css/select2.css') }}" rel="stylesheet" type="text/css" />

@stop
@section('content')
                <section class="content-header">
                         <h1>Nuevo Vehiculo</h1>
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
                                     <h3 class="box-title">Crear un nuevo registro de Vehiculo</h3>
                                   </div><!-- /.box-header -->
                                           {!! Form:: open(['url'=>'/vehiculos'])!!}
                                               @include('drive.form',['submit'=>'Guardar'])
                                           {!!Form::close()!!}
                             </div><!-- /.col -->
                               </div><!-- /.col -->
                            </div><!-- /.row -->
                   </section><!-- /.content -->
@include('partials.functionMsj')
@endsection

@section('javascripts')
    @include('simpleRef.simple_referential_popout',['comboBox'=>'brand_list','urlmodal'=>'/marcasModal','idpop'=>'brandpop','controllermodal'=>'\Brand'])
@append

