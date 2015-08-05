@extends('app2')


@section('css')
 <link href="{{ asset('/css/select2.css') }}" rel="stylesheet" type="text/css" />

@stop
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

                                           {!! Form:: open(['url'=>'/zonas'])!!}
                                               @include('zone.form',['submit'=>'Guardar'])
                                           {!!Form::close()!!}

  </div><!-- /.col -->
                               </div><!-- /.col -->
                            </div><!-- /.row -->
                   </section><!-- /.content -->
@include('partials.functionMsj')
{{--@include('simpleRef.simple_referential_modal',['comboBox'=>'city_list','urlmodal'=>'/ciudad','modalreferential'=>'Ciudad','id'=>'dialogCiudad','controllermodal'=>'\City'])--}}

           @endsection
@section('javascripts')

<script src="{{ URL::asset('/js/select2.full.min.js') }}"></script>
<script type="text/javascript">
$("#city_list").select2();
</script>

@stop

