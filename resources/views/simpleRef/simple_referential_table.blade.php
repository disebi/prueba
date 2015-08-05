

 <section class="content-header">
          <h1>
            {{$referencial}}
            <small>de {{$independiente}}       |
            <a class="btn btn-success" href="{{ action('ReferentialControllers'.$controlador.'Controller@create') }}"><i class="fa fa-plus"></i> Nuevo</a></small>
           </h1>




          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> {{$independiente}}</a></li>
            <li><a href="#">{{$referencial}}</a></li>

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
                        <th>Acciones</th>
                      </tr>
                    </thead>
                    <tbody>

                      @foreach($tabla as $tabla)
                      <tr>
                        <td> {{$tabla->id}}</td>
                        <td>{{$tabla->description}}</td>

                        <td>
                        {!! Form::open(array('id'=>'formdelete'.$tabla->id,'method' => 'DELETE', 'route' => array($url.'.destroy', $tabla->id))) !!}
                           <a class="btn btn-default" href="/{{$url}}/{{$tabla->id}}/edit" ><i class="fa fa-edit"></i> </a>

                           {{--<button onclick='return btnClick();' type="submit" class="btn btn-default" title="Eliminar"><i class="fa fa-trash text-danger"></i></button>{!! Form::close() !!}--}}
                            <a class="btn btn-default" onclick="askDelete({{$tabla->id}})"><i class="fa fa-trash text-danger"></i></a>

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




