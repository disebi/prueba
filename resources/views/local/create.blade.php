@extends('app2')

@section('css')
 <link href="{{ asset('/css/select2.css') }}" rel="stylesheet" type="text/css" />
@append

@section('content')

        <section class="content-header ">
                         <h1>Nuevo {{$referencial}}<small>de {{$independiente}}</small> </h1>
                   <ol class="breadcrumb">
                           <li><a href="#"><i class="fa fa-dashboard"></i>{{$independiente}}</a></li>
                           <li><a href="#">{{$referencial}}</a></li>
                  </ol>
                </section>


                   <!-- Main content -->
                <section class="content">
                             <div class="row animsition">
                               <div class="col-xs-12">
                                 <div class="box box-primary">
                                   <div class="box-header" >
                                     <h3 class="box-title">Crear un nuevo registro de {{$referencial}}</h3>
                                   </div><!-- /.box-header -->

                                           {!! Form:: open(['url'=>'/clientes'])!!}

                                               @include('local.form',['submit'=>'Guardar'])

                                           {!!Form::close()!!}

                                </div>
                               </div><!-- /.col -->
                            </div><!-- /.row -->
                   </section><!-- /.content -->

{{--@include('zone.modals')--}}

@include('partials.functionMsj')
@endsection

@section('javascripts')
<script src="{{ URL::asset('/js/select2.full.min.js') }}"></script>
<script type="text/javascript">
$("#city_list").select2({ width: '100%' });
$("#business_list").select2();
$("#zone_list").select2();
</script>

@append

