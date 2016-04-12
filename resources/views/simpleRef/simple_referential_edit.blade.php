@extends('app2')

@section('bread')
         <h1>Editar {{$referencial}}<small>de {{$independiente}}</small> </h1>
        <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> {{$independiente}}</a></li>
                <li><a href="#">{{$referencial}}</a></li>
       </ol>
@endsection

@section('content')
    <div class="col-xs-12">
       <div class="box">
                        <div class="box-header">
                          <h3 class="box-title">Editar un registro de {{$referencial}}</h3>
                        </div><!-- /.box-header -->
                                {!! Form:: model($model, ['action'=>[$action,$model->id],'method'=>'PATCH'])!!}
                                    @include('simpleRef.simple_referential_form',['submit'=>$submit])
                                {!!Form::close()!!}
                     </div><!-- /.box -->
    </div><!-- /.col -->
@endsection

@section('javascripts')
    @include('partials._functionMsj')
@stop