@extends('app2')

@section('bread')
          <h1>
            {{$referencial}}
            <small>de {{$independiente}}
            </small>
           </h1>
  <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> {{$referencial}}</a></li>
            <li><a href="#">{{$independiente}}</a></li>
   </ol>
@endsection
@section('content')
    <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Listas de registros de {{$referencial}}</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="table" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Descripcion</th>
                        <th>Sucursal</th>
                        <th>Acciones</th>
                     </tr>
                    </thead>
                    <tbody>
                      @foreach($tables as $table)
                          <tr>
                            <td> {{$table->id}}</td>
                            <td>{{$table->description}}</td>
                             <td>{{$table->branch->description}}</td>
                            <td>
                            <a class="btn btn-default" href="/depositos/{{$table->id}}/edit" ><i class="fa fa-edit"></i> </a>
                            {{--{!! Form::open(array('id'=>'formdelete'.$table->id,'method' => 'DELETE', 'route' => array('depositos.destroy', $table->id))) !!}--}}
                               {{--<a class="btn btn-default" onclick="askDelete({{$table->id}})"><i class="fa fa-trash text-danger"></i></a>--}}
                            {{--{!! Form::close() !!}--}}
                           </td>
                          </tr>
                      @endforeach
                    </tbody>

                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->


            </div><!-- /.col -->
@stop
{{--@include('partials.msjdelete')--}}
@include('partials.help._custom_index',['help'=>['edit']])
@include('partials._paginate')
@include('partials._functionMsj')
