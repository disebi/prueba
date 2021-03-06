 <header class="main-header">
        <a href="/" class="logo">
              <!-- mini logo for sidebar mini 50x50 pixels -->
              <span class="logo-mini"><b>2A</b></span>
              <!-- logo for regular state and mobile devices -->
              <span class="logo-lg"><b>2A</b>Admin</span>
            </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>

          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">

              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">

                  <img src="{{ URL::asset('/img/user.png') }}" width="215px" height="215px" class="user-image" alt="User Image"/>
                  <span class="hidden-xs">{{$name}}</span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="{{ URL::asset('/img/user.png') }}" width="215px" height="215px" class="img-circle" alt="User Image" />
                    <p>
                     {{$name}}
                      <small>{{$role}}</small>
                    </p>
                  </li>
                  <!-- Menu Body -->

                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="/perfil" class="btn btn-default btn-flat">Editar Perfil</a>
                    </div>
                    <div class="pull-right">
                      <a href="{{ url('/auth/logout') }}" class="btn btn-default btn-flat">Salir</a>
                    </div>
                  </li>
                </ul>
              </li>
              <li>
                <a href="#control-sidebar-home-tab" data-toggle="control-sidebar"><i class="fa fa-question-circle"></i></a>
                            </li>
            </ul>
          </div>
        </nav>
      </header>