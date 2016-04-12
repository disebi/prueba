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
{{--
1.	Asignar vendedor a zona
2.	Generar visita
3.	Registrar Pedido
4.	Asignar e imprimir orden de trabajo
5.	Registrar control de salida
6.	Registrar control de entrada
7.	Generar comisión a los vendedores
9.	Elaborar informes varios del módulo.



d
d
d--}}
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>Reportes Rapidos</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="/home"><i class="fa fa-circle-o"></i> General</a></li>
                    <li><a href="/home2"><i class="fa fa-circle-o"></i> Vendedores</a></li>
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
                                            <li><a href=""><i class="fa fa-shopping-basket"></i> Asignar Zona</a></li>
                                            <li><a href=""><i class="fa fa-shopping-basket"></i> Generar Visita</a></li>
                                            <li><a href=""><i class="fa fa-shopping-basket"></i> Pedidos</a></li>
                                            <li><a href=""><i class="fa fa-shopping-basket"></i> Orden de Trabajo</a></li>
                                            <li><a href=""><i class="fa fa-shopping-basket"></i> Salidas</a></li>
                                            <li><a href=""><i class="fa fa-shopping-basket"></i> Entradas</a></li>
                                            <li><a href=""><i class="fa fa-shopping-basket"></i>Comisionesk</a></li>
                                            <li><a href=""><i class="fa fa-cubes"></i> Compras</a></li>

                                           </ul>
                                       </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-files-o"></i>
                                <span>Stock</span>
                                <i class="fa fa-angle-left pull-right"></i>

                            </a>
                            <ul class="treeview-menu">
                             <li><a href=""><i class="fa fa-shopping-basket"></i> Nota de Credito</a></li>
                             <li><a href=""><i class="fa fa-shopping-basket"></i> Nota de Devolucion</a></li>
                             <li><a href=""><i class="fa fa-shopping-basket"></i> Ajuste de Stock</a></li>
                             <li><a href=""><i class="fa fa-shopping-basket"></i>Valorizacion de Stock</a></li>
                             <li><a href="{{ action('StockControllers\PurchaseController@index') }}"><i class="fa fa-cubes"></i> Compras</a></li>

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
                    <li><a href="{{ action('ReferentialControllers\BrandController@index') }}"><i class="fa fa-circle-o"></i> Marcas de Vehiculo</a></li>
                    <li><a href="{{ action('ReferentialControllers\DriveController@index') }}"><i class="fa fa-circle-o"></i> Vehiculos</a></li>
                    <li><a href="{{ action('ReferentialControllers\PositionController@index') }}"><i class="fa fa-circle-o"></i> Cargos</a></li>
                    <li><a href="{{ action('ReferentialControllers\BusinessController@index') }}"><i class="fa fa-circle-o"></i> Rubros</a></li>
                    <li><a href="{{ action('ReferentialControllers\ClientController@index') }}"><i class="fa fa-circle-o"></i> Locales</a></li>
                    <li><a href="{{ action('ReferentialControllers\ZoneController@index') }}"><i class="fa fa-circle-o"></i> Zonas</a></li>
                    <li><a href="{{ action('ReferentialControllers\CityController@index') }}"><i class="fa fa-building"></i> Ciudades</a></li>

                </ul>
            </li>

            <li class="treeview">
                                        <a href="#">
                                            <i class="fa fa-files-o"></i>
                                            <span>Stock</span>
                                <i class="fa fa-angle-left pull-right"></i>

                                        </a>
                                        <ul class="treeview-menu">
                                        <li><a href="{{ action('ReferentialControllers\ProductController@index') }}"><i class="fa fa-shopping-basket"></i> Productos</a></li>
                                            <li><a href="{{ action('ReferentialControllers\DepositController@index') }}"><i class="fa fa-circle-o"></i> Depositos</a></li>
                                            <li><a href="{{ action('ReferentialControllers\BranchController@index') }}"><i class="fa fa-circle-o"></i> Sucursales</a></li>

                                        </ul>
                        </li>
            <li class="treeview">
                            <a href="#">
                                <i class="fa fa-files-o"></i>
                                <span>Productos</span>
                    <i class="fa fa-angle-left pull-right"></i>

                            </a>
                            <ul class="treeview-menu">

                                 <li><a href="{{ action('ReferentialControllers\PresentationController@index') }}"><i class="fa fa-circle-o"></i> Presentacion</a></li>
                                @if(\App\Actions::canSeeMenu('line'))
                                <li><a href="{{ action('ReferentialControllers\LineController@index') }}"><i class="fa fa-circle-o"></i> Lineas</a></li>
                                @endif
                                <li><a href="{{ action('ReferentialControllers\AromaController@index') }}"><i class="fa fa-circle-o"></i> Aromas</a></li>
                                <li><a href="{{ action('ReferentialControllers\UnityController@index') }}"><i class="fa fa-circle-o"></i> Unidades de Medida</a></li>
                                 <li><a href="{{ action('ReferentialControllers\ProviderController@index') }}"><i class="fa fa-circle-o"></i> Proveedores</a></li>
                                <li><a href="{{ action('ReferentialControllers\TaxController@index') }}"><i class="fa fa-circle-o"></i> Impuestos</a></li>

                            </ul>
            </li>

            <li class="treeview">
                            <a href="#">
                                <i class="fa fa-files-o"></i>
                                <span>Usuarios</span>
                                <i class="fa fa-angle-left pull-right"></i>

                            </a>
                            <ul class="treeview-menu">
                             <li><a href="{{ action('StaffController@index') }}"><i class="fa fa-users"></i> Usuarios</a></li>
                             <li><a href="{{ action('RoleController@index') }}"><i class="fa fa-lock"></i> Roles</a></li>
                             <li><a href="{{ action('LicenseController@index') }}"><i class="fa fa-key"></i> Permisos</a></li>

                            </ul>
            </li>
            <li class="treeview">
                                        <a href="#">
                                            <i class="fa fa-files-o"></i>
                                            <span>Reportes</span>
                                            <i class="fa fa-angle-left pull-right"></i>

                                        </a>
                                        <ul class="treeview-menu">
                                         {{--<li><a href="{{ action('StaffController@index') }}"><i class="fa fa-users"></i> Usuarios</a></li>--}}
                                         {{--<li><a href="{{ action('RoleController@index') }}"><i class="fa fa-lock"></i> Roles</a></li>--}}
                                         {{--<li><a href="{{ action('LicenseController@index') }}"><i class="fa fa-key"></i> Permisos</a></li>--}}

                                        </ul>
                        </li>
            </ul>


    </section>
    <!-- /.sidebar -->
</aside>

