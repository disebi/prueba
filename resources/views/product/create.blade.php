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
                                     <h3 class="box-title">Crear un nuevo registro de Producto</h3>
                                   </div><!-- /.box-header -->
                                           {!! Form:: open(['url'=>$url])!!}
                                               @include('product.form',['submit'=>$submit])
                                           {!!Form::close()!!}
                             </div><!-- /.col -->
                               </div><!-- /.col -->
                            </div><!-- /.row -->
                   </section><!-- /.content -->
@include('partials.functionMsj')
@endsection

@section('javascripts')
    @include('simpleRef.simple_referential_popout',['comboBox'=>'unity_list','urlmodal'=>'/unidades','idpop'=>'unitypop','controllermodal'=>'\Unity'])
    @include('simpleRef.simple_referential_popout',['comboBox'=>'line_list','urlmodal'=>'/lineas','idpop'=>'linepop','controllermodal'=>'\Line'])
    @include('simpleRef.simple_referential_popout',['comboBox'=>'aroma_list','urlmodal'=>'/aromas','idpop'=>'aromapop','controllermodal'=>'\Aroma'])
    @include('simpleRef.simple_referential_popout',['comboBox'=>'presentation_list','urlmodal'=>'/presentaciones','idpop'=>'presentationpop','controllermodal'=>'\Presentation'])
    @include('simpleRef.simple_referential_popout',['comboBox'=>'tax_list','urlmodal'=>'/inpuestos','idpop'=>'taxpop','controllermodal'=>'\Tax'])
   @append

