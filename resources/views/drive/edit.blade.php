@extends('app2')

@section('css')
 <link href="{{ asset('/css/select2.css') }}" rel="stylesheet" type="text/css" />

@stop

@section('content')

     <section class="content-header">
              <h1>Editar {{$referencial}}<small>de {{$independiente}}</small> </h1>
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
                        <div class="box-header">
                          <h3 class="box-title">Editar un registro de {{$referencial}}</h3>
                        </div><!-- /.box-header -->
                                {!! Form:: model($model, ['action'=>[$action,$model->id],'method'=>'PATCH'])!!}
                                  {!! Form::hidden('id', $model->id) !!}

                                    @include('drive.form',['submit'=>$submit])

                                {!!Form::close()!!}
                     </div><!-- /.box -->

                    </div><!-- /.col -->
                 </div><!-- /.row -->
        </section><!-- /.content -->
@endsection

@section('javascripts')
     @include('partials.functionMsj')
     @include('simpleRef.simple_referential_popout',['comboBox'=>'brand_list','urlmodal'=>'/marcasModal','idpop'=>'brandpop','controllermodal'=>'\Brand'])
@append
