@extends('app2')

@include('partials.bread._index',['button'=>action('ReferentialControllers\CityController@create')])

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

                      @foreach($tabla as $tabla)
                      <tr>
                        <td> {{$tabla->id}}</td>
                        <td>{{$tabla->description}}</td>
                        <td>{{$tabla->branch->description}}</td>

                        <td>
                        {!! Form::open(array('id'=>'formdelete'.$tabla->id,'method' => 'DELETE', 'route' => array($url.'.destroy', $tabla->id))) !!}
                           <a class="btn btn-default" href="/{{$url}}/{{$tabla->id}}/edit" ><i class="fa fa-edit"></i> </a>

                           {{--<button onclick='return btnClick();' type="submit" class="btn btn-default" title="Eliminar"><i class="fa fa-trash text-danger"></i></button>{!! Form::close() !!}--}}
                            <a class="btn btn-default" onclick="askDelete({{$tabla->id}})"><i class="fa fa-trash text-danger"></i></a>

                           {!! Form::close() !!}
                       </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
@stop
@include('partials._paginate')
@include('partials.help._ref_index')
@include('...partials._functionMsj')
@include('partials.msjdelete')


