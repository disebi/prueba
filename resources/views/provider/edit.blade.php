@extends('app2')

@section('content')

     <section class="content-header">
              <h1>Editar proveedor<small>de Productos</small> </h1>
        <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Productos</a></li>
                <li><a href="#">Proveedor</a></li>
       </ol>
     </section>


        <!-- Main content -->
     <section class="content">
                  <div class="row">
                    <div class="col-xs-12">
                      <div class="box">
                        <div class="box-header">
                          <h3 class="box-title">Editar un registro de proveedor</h3>
                        </div><!-- /.box-header -->
                                {!! Form:: model($model, ['action'=>[$action,$model->id],'method'=>'PATCH'])!!}
                                  {!! Form::hidden('id', $model->id) !!}
                                    @include('provider.form',['submit'=>$submit])
                                {!!Form::close()!!}
                     </div><!-- /.box -->

                    </div><!-- /.col -->
                 </div><!-- /.row -->
        </section><!-- /.content -->

@endsection

@section('javascripts')
@include('partials.msj')
@stop