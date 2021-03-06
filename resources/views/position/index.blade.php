@extends('app2')

@section('bread')
          <h1>
            Cargos
            <small>de Emplados    |
            <a class="btn btn-success" href="{{ action('ReferentialControllers\PositionController@create') }}"><i class="fa fa-plus"></i> Nuevo</a></small>
           </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Empleados</a></li>
            <li><a href="#">Cargo</a></li>

          </ol>
@endsection
@section('content')

 <section class="content-header">

 </section>

        <!-- Main content -->
<section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Listas de registros de Cargos</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="table" class="table table-bordered table-striped">

                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Descripcion</th>
                        <th>Monto</th>
                        <th>Periodo</th>
                         <th>Acciones</th>
                      </tr>
                    </thead>
                    <tbody>

                      @foreach($positions as $position)

                      <tr>
                        <td> {{$position->id}}</td>
                        <td>{{$position->description}}</td>
                        <td>{{$position->monto}}</td>
                        <td>{{$position->periodo}}</td>

                        <td>
                        {!! Form::open(array('id'=>'formdelete'.$position->id,'method' => 'DELETE', 'route' => array('cargos.destroy', $position->id))) !!}
                            <a class="btn btn-default" href="/cargos/{{$position->id}}/edit" ><i class="fa fa-edit"></i> </a>
                          {{--<button onclick='return btnClick();' type="submit" class="btn btn-default" title="Eliminar"><i class="fa fa-trash text-danger"></i></button>{!! Form::close() !!}--}}
                            <a class="btn btn-default" onclick="askDelete({{$position->id}})"><i class="fa fa-trash text-danger"></i></a>

                        {!! Form::close() !!}

                       </td>
                      </tr>
                      @endforeach

                    </tbody>

                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->


            </div><!-- /.col -->
          </div><!-- /.row -->

</section><!-- /.content -->
@stop
@include('partials.help._ref_index')
@include('partials._paginate')
@include('partials._functionMsj')
@include('partials.msjdelete')
