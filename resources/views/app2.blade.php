<!DOCTYPE html>
<html>
         <head>
    <meta charset="UTF-8">
    <title>2A ADMIN</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    @include('partials._css')
   </head>

<body class="sidebar skin-yellow">
<div class="wrapper">
             @include('partials.navbar')

                  <!-- Left side column. contains the logo and sidebar -->
             @include('partials.slide')

          <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <div class="row animated fadeIn">
                    <div class="col-md-12">
                        <!-- Content Header (Page header) -->
                        <section class="content-header">
                        @yield('bread')

                        </section>
                        <section class="content animsition">
                         <div class="row-fluid animated fade-in">
                             @yield('content')
                          </div>
                        </section>
                  </div><!-- /.content-wrapper -->
                </div><!-- /.content-wrapper -->
            </div><!-- /.content-wrapper -->
         <footer class="main-footer">
                 <div class="pull-right hidden-xs">
                   <b>Version</b> 2.0
                 </div>
                 <strong>DS 2016 </strong> All rights reserved.
         </footer>
        </div><!-- ./wrapper -->
  </body>

        @include('partials.rightslide')
        @include('partials.script')
        @yield('footer')

</html>