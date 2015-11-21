@extends('app2')

@section('content')

 <section class="content-header">
          <h1>
            {{$referencial}}
            <small>de {{$independiente}}      |
            <a class="btn btn-success" href="{{ action('ReferentialControllers'.$controlador.'Controller@create') }}"><i class="fa fa-plus"></i> Nuevo</a></small>
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
                  <h3 class="box-title">Listas de registros de {{$referencial}}</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="tablalista" class="table table-bordered table-striped">

                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Descripcion</th>
                        <th>Sucursal</th>


                      </tr>
                    </thead>
                    <tbody>

                      @foreach($tables as $table)

                      <tr>
                        <td> {{$table->id}}</td>
                        <td>{{$table->description}}</td>
                         <td>{{$table->branch->description}}</td>

                        <td>
                        {!! Form::open(array('id'=>'formdelete'.$table->id,'method' => 'DELETE', 'route' => array('depositos.destroy', $table->id))) !!}

                           <a class="btn btn-default" href="/depositos/{{$table->id}}/edit" ><i class="fa fa-edit"></i> </a>

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