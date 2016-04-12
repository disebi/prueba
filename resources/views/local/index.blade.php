@extends('app2')
@include('partials.bread._index',['button'=>action('ReferentialControllers\ClientController@create')])
@section('content')
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Listas de registros de {{$referencial}}</h3>
                </div><!-- /.box-header -->
                <div id="dialog" class="modal fade">
                   </div>
                <div class="box-body">
                  <table id="table" class="table table-bordered table-striped">

                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Descripcion</th>
                        <th>Ciudad</th>
                        <th>Zona</th>
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

                         <td>{{$table->zone->city->description}}</td>
                         <td>{{$table->zone->description}}</td>

                         <td>{{$table->zone->comision}}</td>
                         <td>{{$table->zone->km}}</td>
                        <td>
                        {!! Form::open(array('id'=>'formdelete'.$table->id,'method' => 'DELETE', 'route' => array('clientes.destroy', $table->id))) !!}
                            <a class="btn btn-default" onclick="modal('{{$table->description}}','{{$table->ruc}}','{{$table->razon}}','{{$table->tel}}','{{ $table->direcc}}','{{$table->nombre}}','{{$table->apellido}}','{{$table->zone->description}}','{{$table->business->description}}')"><i class="fa fa-search text-aqua"></i></a>
                            <a class="btn btn-default" href="/clientes/{{$table->id}}/edit" ><i class="fa fa-edit"></i> </a>
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
@include('partials._paginate')
@include('partials._functionMsj')
@include('partials.msjdelete')
@section('javascripts')

<script type="text/javascript">

function modal (description,ruc,razon,tel,direcc,nom,apel,zona,rubro){

document.getElementById("dialog").innerHTML="";
document.getElementById("dialog").innerHTML=
 '<div id="dialog" class="modal-dialog modal-sm">' +
  '<div class="modal-content">'+
       ' <div class="modal-header">'+
           ' <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>'+
               ' <h4 class="modal-title">'+description+'</h4>'+
                '   </div>'+
           ' <div class=" modal-body" style="align-items: center">'+
          '  <p  style="padding-left: 10px; padding-bottom: 5px"> <b class="text-info">Ruc: </b>'+ruc+'</p>'+
          '  <p style="padding-left: 10px; padding-bottom: 5px"> <b class="text-info">Razon Social: </b>'+razon+'</p>'+
          '  <p  style="padding-left: 10px; padding-bottom: 5px"> <b class="text-info">Nombre del Dueño: </b>'+nom+'</p>'+
          '  <p  style="padding-left: 10px; padding-bottom: 5px"> <b class="text-info">Apellido del Dueño: </b>'+apel+'</p>'+
          ' <p style="padding-left: 10px; padding-bottom: 5px"> <b class="text-info">Zona: </b>'+zona+'</p>'+
            ' <p style="padding-left: 10px; padding-bottom: 5px"> <b class="text-info">Rubro: </b>'+rubro+'</p>'+
            ' <p style="padding-left: 10px; padding-bottom: 5px"> <b class="text-info">Direccion: </b>'+direcc+'</p>'+
           '   <p  style="padding-left: 10px; padding-bottom: 5px"> <b class="text-info">Telefono: </b>'+tel+'</p> ' +
            '</div>'+

                                                      ' <div class="modal-footer">'+
                                                          ' <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>'+
                                                      '  </div>'+
                                                       '  </div>'+

       '</div>';
   $("#dialog").modal('show');
   }
  </script>
@stop