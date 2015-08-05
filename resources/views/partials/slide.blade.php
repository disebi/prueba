<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ URL::asset('/img/avatar2.png') }}" class="img-circle" alt="User Image" />
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
                    <li><a href="../../index.html"><i class="fa fa-circle-o"></i> Dashboard v1</a></li>
                    <li><a href="../../index2.html"><i class="fa fa-circle-o"></i> Dashboard v2</a></li>
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
                 <li><a href="{{ action('ReferentialControllers\BranchController@index') }}"><i class="fa fa-circle-o"></i> Sucursales</a></li>

                    <li><a href="{{ action('ReferentialControllers\PositionController@index') }}"><i class="fa fa-circle-o"></i> Cargos</a></li>
                    <li><a href="{{ action('ReferentialControllers\BusinessController@index') }}"><i class="fa fa-circle-o"></i> Rubros</a></li>
                    <li><a href="{{ action('ReferentialControllers\BrandController@index') }}"><i class="fa fa-circle-o"></i> Marcas de Vehiculo</a></li>
                    <li><a href="{{ action('ReferentialControllers\CityController@index') }}"><i class="fa fa-building"></i> Ciudades</a></li>
                     <li><a href="{{ action('ReferentialControllers\ZoneController@index') }}"><i class="fa fa-circle-o"></i> Zonas</a></li>
                    <li><a href="{{ action('ReferentialControllers\ClientController@index') }}"><i class="fa fa-circle-o"></i> Locales</a></li>


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
                                <li><a href="{{ action('ReferentialControllers\LineController@index') }}"><i class="fa fa-circle-o"></i> Lineas</a></li>
                                <li><a href="{{ action('ReferentialControllers\AromaController@index') }}"><i class="fa fa-circle-o"></i> Aromas</a></li>
                                <li><a href="{{ action('ReferentialControllers\UnityController@index') }}"><i class="fa fa-circle-o"></i> Unidades de Medida</a></li>
                                 <li><a href="{{ action('ReferentialControllers\ProviderController@index') }}"><i class="fa fa-circle-o"></i> Proveedores</a></li>

                            </ul>
                        </li>
            </ul>
    </section>
    <!-- /.sidebar -->
</aside>

