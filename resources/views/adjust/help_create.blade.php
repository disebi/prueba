 @section('help')
 <h3 class="control-sidebar-heading">Ayuda de {{$referencial}} </h3>

 <div class="row">
 <div class="col-lg-12">
    <p> En esta pagina podra crear una nueva compra de {{$referencial}} de  {{$independiente}}</p>
 </div>
 </div>
 <ul class="control-sidebar-menu">
             <li>
              <a>
                               <i class="menu-icon fa fa-angle-left bg-yellow"></i>
                               <div class="menu-info">
                                 <h4 class="control-sidebar-subheading">Elegir Proveedor</h4>
                                 <p>En primer lugar tendra que elegir un proveedor al cual realizar las compras</p>
                               </div>
                             </a>
             </li>


             <li>
                                            <a>
                                              <i class="menu-icon fa fa-plus  bg-green"></i>
                                              <div class="menu-info">
                                                <h4 class="control-sidebar-subheading">Agregar Productos</h4>
                                                <p>Con este boton podra agregar productos a su detalle de compras.</p>
                                              </div>
                                            </a>
                                          </li>


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