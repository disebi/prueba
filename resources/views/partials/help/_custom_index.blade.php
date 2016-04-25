 @section('help')
 <h3 class="control-sidebar-heading">Ayuda de {{$referencial}} </h3>

 <div class="row">
 <div class="col-lg-12">
    <p> En esta pagina podra visualizar toda la lista de registros de {{$referencial}} de  {{$independiente}}</p>
 </div>
 </div>
  <ul class="control-sidebar-menu">
  @if(in_array('edit',$help))
              <li>
                <a>
                  <i class="menu-icon fa fa-edit  bg-yellow"></i>
                  <div class="menu-info">
                    <h4 class="control-sidebar-subheading">Editar</h4>
                    <p>Con este bonton podra Editar el registro de {{$referencial}}</p>
                  </div>
                </a>
              </li>
  @endif
  @if(in_array('create',$help))
              <li>
                <a>
                  <i class="menu-icon fa fa-plus bg-green"></i>
                  <div class="menu-info">
                    <h4 class="control-sidebar-subheading">Nuevo</h4>
                    <p>Con este bonton podra crear un nuevo registro</p>
                  </div>
                </a>
              </li>
  @endif
  @if(in_array('destroy',$help))
              <li>
                <a>
                  <i class="menu-icon fa fa-trash bg-red"></i>
                  <div class="menu-info">
                    <h4 class="control-sidebar-subheading">Eliminar</h4>
                    <p>Con este bonton podra eliminar un registro</p>
                  </div>
                </a>
              </li>
    @endif

    @if(in_array('disabled',$help))
                  <li>
                    <a>
                      <i class="menu-icon fa fa-thumbs-up bg-aqua"></i>
                      <div class="menu-info">
                        <h4 class="control-sidebar-subheading">Habilitar</h4>
                        <p>Con este bonton podra habilitar el registro</p>
                      </div>
                    </a>
                  </li>

                   <li>
                    <a>
                      <i class="menu-icon fa fa-thumbs-down bg-red"></i>
                       <div class="menu-info">
                                          <h4 class="control-sidebar-subheading">Deshabilitar</h4>
                                          <p>Con este bonton podra deshabilitar el registro</p>
                                        </div>
                    </a>
                   </li>
        @endif
     </ul><!-- /.control-sidebar-menu -->
 
  @append