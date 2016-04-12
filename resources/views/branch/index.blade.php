@extends('app2')

@include('partials.bread._index',['button'=>action('ReferentialControllers\BranchController@create')])

@section('content')
<div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Listas de registros de Sucursales</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="tablalista" class="table table-bordered table-striped">

                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Descripcion</th>
                        <th>Direccion</th>
                        <th>Telefono</th>
                        <th>Mail</th>
                        <th>Acciones</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($branches as $branch)
                      <tr>
                        <td> {{$branch->id}}</td>
                        <td>{{$branch->description}}</td>
                         <td>{{$branch->direcc}}</td>
                        <td>{{$branch->tel}}</td>
                        <td>{{$branch->mail}}</td>

                        <td>
                          <a class="btn btn-default" title="Editar" href="/sucursales/{{$branch->id}}/edit" ><i class="fa fa-edit"></i> </a>
                        {{--{!! Form::open(array('id'=>'formdelete'.$branch->id,'method' => 'DELETE', 'route' => array('sucursales.destroy', $branch->id))) !!}--}}
                           {{--<a class="btn btn-default" onclick="askDelete({{$branch->id}})"><i class="fa fa-trash text-danger"></i></a>--}}
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
@include('partials.help._custom_index',['help'=>['create','edit']])
@include('...partials._functionMsj')
@include('...partials._paginate')
