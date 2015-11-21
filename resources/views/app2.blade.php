<!DOCTYPE html>
<html>
         <head>
    <meta charset="UTF-8">
    <title>2A ADMIN</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
  @include('partials.css')
    @yield('css')
  </head>


     <body class="skin-yellow">

  </body>
        <div class="wrapper">
             @include('partials.navbar')

                  <!-- Left side column. contains the logo and sidebar -->
             @include('partials.slide')

          <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
            <!-- Content Header (Page header) -->
                         @yield('content')
            </div><!-- /.content-wrapper -->
         <footer class="main-footer">
                 <div class="pull-right hidden-xs">
                   <b>Version</b> 2.0
                 </div>
                 <strong>DS 2015 <a href="http://almsaeedstudio.com"></a>.</strong> All rights reserved.
               </footer>
        </div><!-- ./wrapper -->
        @yield('sidebar')

            @include('partials.script')
            @yield('javascripts')
            @yield('footer')

</html>