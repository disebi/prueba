@extends('app2')

@section('content')

 <section class="content-header">
          <h1>
            Sucursales
            <small>de la Empresa    |
            <a class="btn btn-success" href="{{ action('ReferentialControllers\BranchController@create') }}"><i class="fa fa-plus"></i> Nuevo</a></small>
           </h1>




          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> de la Empresa</a></li>
            <li><a href="#">Sucursales</a></li>

          </ol>
 </section>

        <!-- Main content -->
<section class="content">
          <div class="row">
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
                        {!! Form::open(array('id'=>'formdelete'.$branch->id,'method' => 'DELETE', 'route' => array('sucursales.destroy', $branch->id))) !!}
                            <a class="btn btn-default" href="/sucursales/{{$branch->id}}/edit" ><i class="fa fa-edit"></i> </a>
                          {{--<button onclick='return btnClick();' type="submit" class="btn btn-default" title="Eliminar"><i class="fa fa-trash text-danger"></i></button>{!! Form::close() !!}--}}
                            <a class="btn btn-default" onclick="askDelete({{$branch->id}})"><i class="fa fa-trash text-danger"></i></a>

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