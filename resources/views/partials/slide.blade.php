<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ URL::asset('/img/user.png') }}" width="215px" height="215px" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
                <p>{{$name}}</p>

                <a href="#"> Tipo de Cuenta</a>
            </div>
        </div>
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='seach' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu animsition">

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>Reportes Rapidos</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="/home"><i class="fa fa-circle-o"></i> General</a></li>
                </ul>
            </li>
            <li class="header">Departamentos</li>
            <li class="treeview">
                  <a href="#">
                     <i class="fa fa-files-o"></i>
                                               <span>Distribucion</span>
                                               <i class="fa fa-angle-left pull-right"></i>

                                           </a>
                    <ul class="treeview-menu">
                        @if(\Auth::user()->hasAccess('assign.all'))
                        <li><a href="{{ action('DistributionControllers\ZoneAssignController@index') }}"><i class="fa fa-shopping-basket"></i> Asignar Zona</a></li>
                        @endif
                        @if(\Auth::user()->hasAccess('visit.all'))
                        <li><a href="{{ action('DistributionControllers\VisitController@index') }}"><i class="fa fa-shopping-basket"></i> Generar Visita</a></li>
                        @endif
                        @if(\Auth::user()->hasAccess('order.all'))
                        <li><a href="{{ action('DistributionControllers\OrderController@index') }}"><i class="fa fa-shopping-basket"></i> Pedidos</a></li>
                        @endif
                        @if(\Auth::user()->hasAccess('workorder.all'))
                        <li><a href="{{ action('DistributionControllers\WorkController@index') }}"><i class="fa fa-shopping-basket"></i> Orden de Trabajo</a></li>
                        @endif
                        @if(\Auth::user()->hasAccess('out.all'))
                        <li><a href=""><i class="fa fa-shopping-basket"></i> Salidas</a></li>
                        @endif
                        @if(\Auth::user()->hasAccess('back.all'))
                        <li><a href=""><i class="fa fa-shopping-basket"></i> Entradas</a></li>
                        @endif
                         @if(\Auth::user()->hasAccess('sale.all'))
                        <li><a href="{{ action('DistributionControllers\SaleController@index') }}"><i class="fa fa-cubes"></i> Ventas</a></li>
                        @endif
                         @if(\Auth::user()->hasAccess('commission.all'))
                        <li><a href="{{action('ReportController@commission')}}"><i class="fa fa-shopping-basket"></i>Comisiones</a></li>
                        @endif
                     </ul>
            </li>
            <li class="treeview">
                            <a href="#">
                                <i class="fa fa-files-o"></i>
                                <span>Stock</span>
                                <i class="fa fa-angle-left pull-right"></i>

                            </a>
                            <ul class="treeview-menu">
                             @if(\Auth::user()->hasAccess('purchase.all'))
                             <li><a href="{{ action('StockControllers\PurchaseController@index') }}"><i class="fa fa-cubes"></i> Compras</a></li>
                             @endif
                             @if(\Auth::user()->hasAccess('adjust.all'))
                             <li><a href="{{ action('StockControllers\AdjustController@index') }}"><i class="fa fa-shopping-basket"></i> Ajuste de Stock</a></li>
                             @endif
                             @if(\Auth::user()->hasAccess('return.all'))
                             <li><a href="{{ action('StockControllers\ReturnNoteController@index') }}"><i class="fa fa-shopping-basket"></i> Nota de Devolucion</a></li>
                             @endif
                             @if(\Auth::user()->hasAccess('remission.all'))
                             <li><a href="{{ action('StockControllers\ReturnNoteController@index') }}"><i class="fa fa-shopping-basket"></i> Nota de Remision</a></li>
                             @endif
                             @if(\Auth::user()->hasAccess('value.all'))
                             <li><a href=""><i class="fa fa-shopping-basket"></i>Valorizacion de Stock</a></li>
                             @endif
                             @if(\Auth::user()->hasAccess('credit.all'))
                             <li><a href="{{ action('StockControllers\CreditController@index') }}"><i class="fa fa-shopping-basket"></i> Nota de Credito</a></li>
                             @endif
                            </ul>
                        </li>
            <li class="header">Referenciales</li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-files-o"></i>
                    <span>Distribucion</span>
                    <i class="fa fa-angle-left pull-right"></i>

                </a>
                <ul class="treeview-menu">
                    @if(\Auth::user()->hasAccess('brand.all'))
                    <li><a href="{{ action('ReferentialControllers\BrandController@index') }}"><i class="fa fa-circle-o"></i> Marcas de Vehiculo</a></li>
                    @endif
                    @if(\Auth::user()->hasAccess('drive.all'))
                    <li><a href="{{ action('ReferentialControllers\DriveController@index') }}"><i class="fa fa-circle-o"></i> Vehiculos</a></li>
                    @endif
                    @if(\Auth::user()->hasAccess('city.all'))
                    <li><a href="{{ action('ReferentialControllers\CityController@index') }}"><i class="fa fa-building"></i> Ciudades</a></li>
                    @endif
                    @if(\Auth::user()->hasAccess('busisness.all'))
                    <li><a href="{{ action('ReferentialControllers\BusinessController@index') }}"><i class="fa fa-circle-o"></i> Rubros</a></li>
                    @endif
                    @if(\Auth::user()->hasAccess('client.all'))
                    <li><a href="{{ action('ReferentialControllers\ClientController@index') }}"><i class="fa fa-circle-o"></i> Locales</a></li>
                    @endif
                    @if(\Auth::user()->hasAccess('zone.all'))
                    <li><a href="{{ action('ReferentialControllers\ZoneController@index') }}"><i class="fa fa-circle-o"></i> Zonas</a></li>
                    @endif
                    @if(\Auth::user()->hasAccess('stamping.all'))
                    <li><a href="{{ action('ReferentialControllers\StampingController@index') }}"><i class="fa fa-building"></i> Timbrados</a></li>
                    @endif
               </ul>
            </li>
            <li class="treeview">
                                        <a href="#">
                                            <i class="fa fa-files-o"></i>
                                            <span>Stock</span>
                                <i class="fa fa-angle-left pull-right"></i>

                                        </a>
                                        <ul class="treeview-menu">
                                        @if(\Auth::user()->hasAccess('product.all'))
                                        <li><a href="{{ action('ReferentialControllers\ProductController@index') }}"><i class="fa fa-shopping-basket"></i> Productos</a></li>
                                        @endif
                                        @if(\Auth::user()->hasAccess('deposit.all'))
                                        <li><a href="{{ action('ReferentialControllers\DepositController@index') }}"><i class="fa fa-circle-o"></i> Depositos</a></li>
                                        @endif
                                        @if(\Auth::user()->hasAccess('branch.all'))
                                        <li><a href="{{ action('ReferentialControllers\BranchController@index') }}"><i class="fa fa-circle-o"></i> Sucursales</a></li>
                                        @endif
                                        </ul>
                        </li>
            <li class="treeview">
                            <a href="#">
                                <i class="fa fa-files-o"></i>
                                <span>Productos</span>
                    <i class="fa fa-angle-left pull-right"></i>

                            </a>
                            <ul class="treeview-menu">
                                @if(\Auth::user()->hasAccess('presentation.all'))
                                <li><a href="{{ action('ReferentialControllers\PresentationController@index') }}"><i class="fa fa-circle-o"></i> Presentacion</a></li>
                                @endif
                                @if(\Auth::user()->hasAccess('line.all'))
                                <li><a href="{{ action('ReferentialControllers\LineController@index') }}"><i class="fa fa-circle-o"></i> Lineas</a></li>
                                @endif
                                 @if(\Auth::user()->hasAccess('aroma.all'))
                                <li><a href="{{ action('ReferentialControllers\AromaController@index') }}"><i class="fa fa-circle-o"></i> Aromas</a></li>
                                @endif
                                @if(\Auth::user()->hasAccess('unity.all'))
                                <li><a href="{{ action('ReferentialControllers\UnityController@index') }}"><i class="fa fa-circle-o"></i> Unidades de Medida</a></li>
                                @endif
                                @if(\Auth::user()->hasAccess('provider.all'))
                                <li><a href="{{ action('ReferentialControllers\ProviderController@index') }}"><i class="fa fa-circle-o"></i> Proveedores</a></li>
                                @endif
                                @if(\Auth::user()->hasAccess('tax.all'))
                                <li><a href="{{ action('ReferentialControllers\TaxController@index') }}"><i class="fa fa-circle-o"></i> Impuestos</a></li>
                                @endif
                            </ul>
            </li>
              <li class="header">Reportes</li>
                <li class="treeview">
                                                                   <a href="#">
                                                                       <i class="fa fa-files-o"></i>
                                                                       <span>Distribucion</span>
                                                                       <i class="fa fa-angle-left pull-right"></i>

                                                                   </a>
                                                                   <ul class="treeview-menu">
                                                                    @if(\Auth::user()->hasAccess('report_salesmen.all'))
                                                                    <li><a href="{{ action('ReportController@salesman') }}"><i class="fa fa-cubes"></i> Reportes de Vendedores</a></li>
                                                                    @endif
                                                                    @if(\Auth::user()->hasAccess('report_visit.all'))
                                                                    <li><a href="{{ action('ReportController@visits') }}"><i class="fa fa-shopping-basket"></i> Reportes de Visitas</a></li>
                                                                    @endif
                                                                    @if(\Auth::user()->hasAccess('report_order.all'))
                                                                    <li><a href="{{ action('ReportController@orders') }}"><i class="fa fa-shopping-basket"></i> Reportes de Pedidos</a></li>
                                                                    @endif

                                                                   </ul>
                                                               </li>
                <li class="treeview">
                                                    <a href="#">
                                                        <i class="fa fa-files-o"></i>
                                                        <span>Stock</span>
                                                        <i class="fa fa-angle-left pull-right"></i>

                                                    </a>
                                                    <ul class="treeview-menu">
                                                    @if(\Auth::user()->hasAccess('report_remission.all'))
                                                     <li><a href=""><i class="fa fa-cubes"></i> Reportes de remision</a></li>
                                                     @endif
                                                    @if(\Auth::user()->hasAccess('report_mov.all'))
                                                     <li><a href=""><i class="fa fa-shopping-basket"></i> Reportes de Movimientos</a></li>
                                                     @endif


                                                    </ul>
                </li>
            <li class="header">Usuarios</li>
                <li class="treeview">
                                        <a href="#">
                                            <i class="fa fa-files-o"></i>
                                            <span>Usuarios</span>
                                            <i class="fa fa-angle-left pull-right"></i>

                                        </a>
                                        <ul class="treeview-menu">
                                         @if(\Auth::user()->hasAccess('user.all'))
                                         <li><a href="{{ action('StaffController@index') }}"><i class="fa fa-users"></i> Usuarios</a></li>
                                         @endif
                                          @if(\Auth::user()->hasAccess('role.all'))
                                         <li><a href="{{ action('RoleController@index') }}"><i class="fa fa-lock"></i> Roles</a></li>
                                       @endif
                                        @if(\Auth::user()->hasAccess('license.all'))
                                        <li><a href="{{ action('LicenseController@index') }}"><i class="fa fa-key"></i> Permisos</a></li>
                                        @endif
                                         @if(\Auth::user()->hasAccess('position.all'))
                                         <li><a href="{{ action('ReferentialControllers\PositionController@index') }}"><i class="fa fa-circle-o"></i> Cargos</a></li>
                                           @endif
                                        </ul>
                        </li>
         </ul>




    </section>
    <!-- /.sidebar -->
</aside>

