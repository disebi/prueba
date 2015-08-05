@extends('app2')

@section('content')

     <section class="content-header">
              <h1>Editar cargo<small>de Empleados</small> </h1>
        <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Cargos</a></li>
                <li><a href="#">Empleado</a></li>
       </ol>
     </section>


        <!-- Main content -->
     <section class="content">
                  <div class="row">
                    <div class="col-xs-12">
                      <div class="box">
                        <div class="box-header">
                          <h3 class="box-title">Editar un registro de cargo</h3>
                        </div><!-- /.box-header -->
                                {!! Form:: model($model, ['action'=>[$action,$model->id],'method'=>'PATCH'])!!}
                                 {!! Form::hidden('id', $model->id) !!}
                                    @include('position.form',['submit'=>$submit])
                                {!!Form::close()!!}
                     </div><!-- /.box -->

                    </div><!-- /.col -->
                 </div><!-- /.row -->
        </section><!-- /.content -->

@endsection

@section('javascripts')
@include('partials.msj')
@stop