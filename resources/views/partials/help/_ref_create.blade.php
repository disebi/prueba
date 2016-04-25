 @section('help')
 <h3 class="control-sidebar-heading">Ayuda de {{$referencial}} </h3>

 <div class="row">
 <div class="col-lg-12">
    <p> En esta pagina podra crear un nuevo registro de {{$referencial}} de  {{$independiente}}</p>
 </div>
 </div>
 <ul class="control-sidebar-menu">
             <li>
                             <a>
                               <i class="menu-icon fa fa-angle-left bg-yellow"></i>
                               <div class="menu-info">
                                 <h4 class="control-sidebar-subheading">Crear {{$referencial}}</h4>
                                 <p>Antes de crear un nuevo registro debe de completar todo el formulario, si existe algun error encontrara mensajes que lo ayudaran a completar con exito el formulario</p>
                               </div>
                             </a>
                           </li>
                @if(isset($help) && in_array('plus',$help))
                            <li>
                              <a>
                                <i class="menu-icon fa fa-plus  bg-green"></i>
                                <div class="menu-info">
                                  <h4 class="control-sidebar-subheading">Agregar Registros Rapidos</h4>
                                  <p>Con este boton podra agregar registros rapidos cuando los necesite, Ej.: Aroma Nuevo, Marca de Vehiculo nuevo, etc.</p>
                                </div>
                              </a>
                            </li>
                @endif




              <li>
                <a>
                  <div class="menu-info">
                  <i class="btn btn-primary">Guardar</i>
                    <h4 class="control-sidebar-subheading" style="padding-top: 10px">Guardar</h4>
                    <p>Con este bonton podra Guardar el registro de {{$referencial}}</p>
                  </div>
                </a>
              </li>


</ul><!-- /.control-sidebar-menu -->
  @append