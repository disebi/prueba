@extends('app2')
@include('partials.bread._index',['button'=>action('StaffController@create')])

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
                        <td> {{$table->id   }}</td>
                        <td>{{$table->name.' '. $table->last_name}}</td>
                         <td>{{$table->branch->description}}</td>
                         <td>{{number_format($table->ci, 0, '', '.')}} </td>
                         <td>{{ (new \Carbon\Carbon($table->birth_date))->diff(\Carbon\Carbon::now())->format('%y años')}}</td>
                         <td>{{$table->tel}}</td>
                         <td>{{$table->direcc}}</td>
                        <td>
                             {!! Form::open(array('id'=>'formup'.$table->user_id,'method' => 'PATCH', 'route' => array('usuarios.activeUser', $table->user_id))) !!}
                                                   <a class="btn btn-default" href="/usuarios/{{$table->user_id}}/edit" ><i class="fa fa-edit"></i> </a>
                                                   <a class="btn btn-default" onclick="askActivate( {{$table->user_id}} )"
                                                                                                      @if($table->user->active)
                                                                                                       title="Deshabilitar"><i class="fa fa-thumbs-down text-danger"></i>
                                                                                                      @else
                                                                                                       title="Habilitar"><i class="fa fa-thumbs-up text-success"></i>
                                                                                                      @endif
                                                                                                       </a>

                                                {!! Form::close() !!}

                                                {{--{!! Form::open(array('id'=>'formup'.$table->id,'method' => 'PATCH', 'action'=>['UserController@activate',$table->id])) !!}--}}
                                                {{--{!! Form::close() !!}--}}
                                               {{--</td>--}}


                       </td>
                      </tr>
                      @endforeach

                    </tbody>

                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
@endsection
@include('partials.help._custom_index', ['help'=>['create','edit','disabled']])
@include('partials._paginate')
@include('partials._functionMsj')

@section('javascripts')
<script type="text/javascript">
 var form='';
 function askActivate(nro){

             form ='formup'+nro;
             console.log(form);
             var n = noty({
                                  text        : '<div class="activity-item">  ' +
                                   '<div class="activity" style="font-size:15px; font-family: "Roboto", Helvetica, Arial, sans-serif">' +
                                    ' Desea cambiar el estado de este usuario? </div> </div>',
                                  type        : 'alert',
                                  dismissQueue: true,
                                  timeout     : 10000,
                                  layout      : 'bottomRight',
                                  theme       : 'relax',
                                  maxVisible  : 3,
                                  animation   : {
                                                  open  : 'animated bounceInRight',
                                                  close : 'animated bounceOutRight',
                                                  easing: 'swing',
                                                  speed : 500
                                                 },
                                  buttons     : [
                                      {addClass: 'btn btn-primary', text: 'Si', onClick: function ($noty) {
                                          $noty.close();

                                          document.getElementById(form).submit(function() {

                                              });

                                         }
                                      },
                                      {addClass: 'btn btn-danger', text: 'Cancelar', onClick: function ($noty) {
                                          $noty.close();
                                            }
                                      }
                                  ]
             });}
</script>
@append