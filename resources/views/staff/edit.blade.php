@extends('app2')

           @include('partials.bread._edit')
           @include('partials.help._ref_edit')
@section('content')
    <div class="col-xs-12">
                      <div class="box">
                        <div class="box-header">
                          <h3 class="box-title">Editar un registro de {{$referencial}}</h3>
                        </div><!-- /.box-header -->
                                {!! Form:: model($staff, ['action'=>[$action,$staff->id],'method'=>'PATCH'])!!}
                                  {!! Form::hidden('id', $staff->id) !!}
                                  {!! Form::hidden('user_id', $user->id) !!}
                                    @include('staff.form',['submit'=>$submit])
                                {!!Form::close()!!}
                     </div><!-- /.box -->
    </div><!-- /.col -->
@endsection
@include('...partials._functionMsj')