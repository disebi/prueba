@extends('app2')

@include('partials.bread._index',['button'=>action('ReferentialControllers\DriveController@create')])


@section('content')
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Listas de registros de Vehiculos</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="table" class="table table-bordered table-striped">

                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Marca</th>
                        <th>Descripcion</th>
                        <th>Chapa</th>
                        <th>Chasis</th>
                        <th>Año</th>
                         <th>Acciones</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($drives as $drive)
                      <tr>
                        <td> {{$drive->id}}</td>
                         <td>{{$drive->brand->description}}</td>
                        <td>{{$drive->description}}</td>
                         <td>{{$drive->chapa}}</td>
                        <td>{{$drive->chasis}}</td>
                        <td>{{$drive->year}}</td>


                       <td>
                        {!! Form::open(array('id'=>'formdelete'.$drive->id,'method' => 'DELETE', 'route' => array('vehiculos.destroy', $drive->id))) !!}
                            <a class="btn btn-default" href="/vehiculos/{{$drive->id}}/edit" ><i class="fa fa-edit"></i> </a>
                          {{--<button onclick='return btnClick();' type="submit" class="btn btn-default" title="Eliminar"><i class="fa fa-trash text-danger"></i></button>{!! Form::close() !!}--}}
                            <a class="btn btn-default" onclick="askDelete({{$drive->id}})"><i class="fa fa-trash text-danger"></i></a>

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
@include('partials._paginate')
@include('...partials._functionMsj')
@include('partials.msjdelete')
