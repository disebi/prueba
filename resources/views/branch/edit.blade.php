@extends('app2')

@section('bread')
      <h1>Editar sucursal<small>de Empresas</small> </h1>
        <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Sucursal</a></li>
                <li><a href="#">Empresa</a></li>
       </ol>
@endsection
@section('content')
    <div class="col-xs-12">
                      <div class="box">
                        <div class="box-header">
                          <h3 class="box-title">Editar un registro de sucursal</h3>
                        </div><!-- /.box-header -->
                                {!! Form:: model($model, ['action'=>[$action,$model->id],'method'=>'PATCH'])!!}
                                 {!! Form::hidden('id', $model->id) !!}
                                    @include('branch.form',['submit'=>$submit])
                                {!!Form::close()!!}
                     </div><!-- /.box -->

                    </div><!-- /.col -->
@endsection
@include('...partials._functionMsj')
