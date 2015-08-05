@extends('app2')

@section('content')

 <section class="content-header">
          <h1>
            Proveedores
            <small>de Productos       |
            <a class="btn btn-success" href="{{ action('ReferentialControllers\ProviderController@create') }}"><i class="fa fa-plus"></i> Nuevo</a></small>
           </h1>




          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Productos</a></li>
            <li><a href="#">Proveedor</a></li>

          </ol>
 </section>

        <!-- Main content -->
<section class="content animsition">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Listas de registros de Proveedores</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="tablalista" class="table table-bordered table-striped">

                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Descripcion</th>
                        <th>Ruc</th>
                        <th>Acciones</th>
                      </tr>
                    </thead>
                    <tbody>

                      @foreach($providers as $provider)
                        <div id="{{$provider->id}}" class="modal fade">
                             <div class="modal-dialog modal-sm">
                                  <div class="modal-content">
                                      <div class="modal-header">
                                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                          <h4 class="modal-title">{{$provider->description}}</h4>
                                      </div>
                                      <div class=" modal-body" style="align-items: center">
                                           <p  style="padding-left: 10px; padding-bottom: 5px"> <b class="text-info">Telefono: </b>{{$provider->tel}}</p>
                                           <p style="padding-left: 10px; padding-bottom: 5px"> <b class="text-info">Razon Social: </b>{{$provider->razon}}</p>
                                           <p  style="padding-left: 10px; padding-bottom: 5px"> <b class="text-info">Ruc: </b>{{$provider->ruc}}</p>
                                           <p style="padding-left: 10px; padding-bottom: 5px"> <b class="text-info">Direccion: </b>{{$provider->direcc}}</p>
                                           <p  style="padding-left: 10px; padding-bottom: 5px"> <b class="text-info">Mail: </b>{{$provider->mail}}</p>
                                           <p style="padding-left: 10px; padding-bottom: 5px"> <b class="text-info">Web: </b><a href="http://{{$provider->web}}">{{$provider->web}}</a></p>

                                      </div>

                                      <div class="modal-footer">
                                          <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
                                       </div>

                                  </div>

                              </div>

                          </div>
                      <tr>
                        <td> {{$provider->id}}</td>
                        <td>{{$provider->description}}</td>
                        <td>{{$provider->ruc}}</td>
                        <td>
                        {!! Form::open(array('id'=>'formdelete'.$provider->id,'method' => 'DELETE', 'route' => array('proveedores.destroy', $provider->id))) !!}
                           <a class="btn btn-default" onclick="modal({{$provider->id}})" ><i class="fa fa-search"></i> </a>

                           <a class="btn btn-default" href="/proveedores/{{$provider->id}}/edit" ><i class="fa fa-edit"></i> </a>

                           {{--<button onclick='return btnClick();' type="submit" class="btn btn-default" title="Eliminar"><i class="fa fa-trash text-danger"></i></button>{!! Form::close() !!}--}}
                            <a class="btn btn-default" onclick="askDelete({{$provider->id}})"><i class="fa fa-trash text-danger"></i></a>

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
   function modal (id){

   $("#"+id).modal('show');
   }
    </script>

@include('partials.msj')

@stop