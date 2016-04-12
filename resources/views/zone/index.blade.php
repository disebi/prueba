@extends('app2')
@include('partials.bread._index',['button'=>action('ReferentialControllers\ZoneController@create')])

@section('content')
<div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Listas de registros de Zonas</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="table" class="table table-bordered table-striped">

                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Descripcion</th>
                        <th>Ciudad</th>

                          <th>Comision</th>
                          <th>Km</th>
                            <th>Acciones</th>
                      </tr>
                    </thead>
                    <tbody>

                      @foreach($tables as $table)

                      <tr>
                        <td> {{$table->id}}</td>
                        <td>{{$table->description}}</td>
                         <td>{{$table->city->description}}</td>
                         <td>{{$table->comision}} %</td>
                         <td>{{$table->km}}</td>
                        <td>
                        {!! Form::open(array('id'=>'formdelete'.$table->id,'method' => 'DELETE', 'route' => array('zonas.destroy', $table->id))) !!}

                           <a class="btn btn-default" href="/zonas/{{$table->id}}/edit" ><i class="fa fa-edit"></i> </a>

                           {{--<button onclick='return btnClick();' type="submit" class="btn btn-default" title="Eliminar"><i class="fa fa-trash text-danger"></i></button>{!! Form::close() !!}--}}
                            <a class="btn btn-default" onclick="askDelete({{$table->id}})"><i class="fa fa-trash text-danger"></i></a>

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
@include('partials.help._ref_index')
@include('...partials._paginate')
@include('...partials._functionMsj')
@include('partials.msjdelete')

@stop