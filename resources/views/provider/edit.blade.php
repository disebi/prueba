@extends('app2')

@include('partials.bread._edit')
@include('partials.help._ref_edit')
@section('content')

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
@endsection
@section('javascripts')
@include('...partials._functionMsj')
@stop