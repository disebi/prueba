@extends('app2')

           @include('partials.bread._edit')
           @include('partials.help._ref_edit')
@section('content')
                    <div class="col-xs-12">
                      <div class="box">
                        <div class="box-header">
                          <h3 class="box-title">Editar un registro de {{$referencial}}</h3>
                        </div><!-- /.box-header -->
                                {!! Form:: model($model, ['action'=>[$action,$model->id],'method'=>'PATCH'])!!}
                                  {!! Form::hidden('id', $model->id) !!}
                                    @include('zone.form',['submit'=>$submit,'kmt'=>'km','comisiont'=>'comision','descriptiont'=>'description'])
                                {!!Form::close()!!}
                     </div><!-- /.box -->

                    </div><!-- /.col -->
@endsection
@include('...partials._functionMsj')

