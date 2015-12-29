@extends('app2')

@section('content')

 <section class="content-header">
          <h1>
            {{$referencial}}
            <small>de {{$independiente}}      |
            <a class="btn btn-success" href="{{ action('StaffController@create') }}"><i class="fa fa-plus"></i> Nuevo</a></small>
           </h1>




          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> {{$referencial}}</a></li>
            <li><a href="#">{{$independiente}}</a></li>

          </ol>
 </section>

        <!-- Main content -->
<section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Listas de registros de Zonas</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="tablalista" class="table table-bordered table-striped">

                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Sucursal</th>

                          <th>CI</th>
                          <th>Edad</th>
                            <th>Tel</th>
                            <th>Direccion</th>
                            <th>Acciones</th>
                      </tr>
                    </thead>
                    <tbody>

                      @foreach($tables as $table)

                      <tr>
                        <td> {{$table->id}}</td>
                        <td>{{$table->name.' '. $table->last_name}}</td>
                         <td>{{$table->branch->description}}</td>
                         <td>{{number_format($table->ci, 0, '', '.')}} </td>
                         <td>{{ (new \Carbon\Carbon($table->birth_date))->diff(\Carbon\Carbon::now())->format('%y años')}}</td>
                         <td>{{$table->tel}}</td>
                         <td>{{$table->direcc}}</td>
                        <td>
                        {!! Form::open(array('id'=>'formdelete'.$table->id,'method' => 'DELETE', 'route' => array('usuarios.destroy', $table->id))) !!}
                           <a class="btn btn-default" href="/usuarios/{{$table->id}}/edit" ><i class="fa fa-edit"></i> </a>
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
          </div><!-- /.row -->
@include('partials.msjdelete')
</section><!-- /.content -->


@stop

@section('javascripts')
<script type="text/javascript">
  $(function () {
         $("#tablalista").dataTable();
       });
</script>
@include('partials.functionMsj')

@stop