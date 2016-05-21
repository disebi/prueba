<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>2A Admin</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- iCheck -->
    <link href="/plugins/iCheck/square/blue.css" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('/css/animate.css') }}" rel="stylesheet" type="text/css" />
    <script src="{{ URL::asset('/plugins/jQuery/jQuery-2.1.3.min.js') }}"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>
    <style>
    body {
        background: url('/img/bg.jpg') no-repeat fixed center center;
        background-size: cover;
    }


    .login-block {
        width: 320px;
        padding: 20px;
        background: #fff;
        border-radius: 5px;
        border-top: 5px solid #ff9f44;
        margin: 0 auto;
    }

    .login-block h1 {
        text-align: center;
        color: #000;
        font-size: 18px;
        text-transform: uppercase;
        margin-top: 0;
        margin-bottom: 20px;
    }

    .login-block input {
        width: 100%;
        height: 42px;
        box-sizing: border-box;
        border-radius: 5px;
        border: 1px solid #ccc;
        margin-bottom: 20px;
        font-size: 14px;


        outline: none;
    }

    .login-block input#username {
        background: #fff url('http://i.imgur.com/u0XmBmv.png') 20px top no-repeat;
        background-size: 16px 80px;
    }

    .login-block input#username:focus {
        background: #fff url('http://i.imgur.com/u0XmBmv.png') 20px bottom no-repeat;
        background-size: 16px 80px;
    }

    .login-block input#password {
        background: #fff url('http://i.imgur.com/Qf83FTt.png') 20px top no-repeat;
        background-size: 16px 80px;
    }

    .login-block input#password:focus {
        background: #fff url('http://i.imgur.com/Qf83FTt.png') 20px bottom no-repeat;
        background-size: 16px 80px;
    }

    .login-block input:active, .login-block input:focus {
        border: 1px solid #ffa84d;
    }

    .login-block button:hover {
        background: #ffa84d;
    }
    </style>
  <body>


    <div class="login-box">
      <div class="login-logo">
        <h1 style="font-size: larger; color: whitesmoke; text-shadow: 1px 1px 1px #717171;"><b>Admin</b>2A</h1>
      </div><!-- /.login-logo -->
      <div class="login-block">
        <h1 class="login-box-msg"><b>Iniciar Sesion</b> </h1>

        <form role="form" method="POST" action="{{ url('/auth/login') }}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="form-group has-feedback">
            <input type="text" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email"/>
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input name="password" type="password" class="form-control" placeholder="Password"/>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="col-xs-8">
              {{--<div class="checkbox icheck">--}}
                {{--<label>--}}
                  {{--<input name ="remember" type="checkbox"> Remember Me--}}
                {{--</label>--}}
              {{--</div>--}}
            </div><!-- /.col -->
            <div class="col-xs-4">
              <button type="submit" class="btn btn-warning btn-block btn-flat">Ingresar</button>
            </div><!-- /.col -->
          </div>
        </form>

      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->


    <!-- iCheck -->
    <script src="/plugins/iCheck/icheck.min.js" type="text/javascript"></script>

    <script src="{{ URL::asset('/js/noty/jquery.noty.packaged.js') }}"></script>



    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
    </script>
      <script type="text/javascript">
               function mensajito (type,textm) {
                   var n = noty({
                       text        : '<div class="activity-item">  <div class="activity" style="font-size:15px; font-family: "Roboto", Helvetica, Arial, sans-serif">'+textm+' </div> </div>',
                       type        : type,
                       dismissQueue: true,
                       timeout     : 5000,
                       closeWith   : ['click'],
                       layout      : 'bottomRight',
                       theme       : 'bootstrapTheme',
                       maxVisible  : 5,
                       animation   : {
                           open  : 'animated bounceInRight',
                           close : 'animated bounceOutRight',
                           easing: 'swing',
                           speed : 500
                       }
                   });}





          @if (\Session::has('message') || $errors->any())
          $(document).ready(function() {
               @if (\Session::has('message'))
                mensajito(<?php echo json_encode(\Session::get('alert')); ?>,<?php echo json_encode(\Session::get('message')); ?>);
               @endif
               @if($errors->any())
                      @foreach($errors->all() as $error)
                        mensajito('error',<?php echo json_encode($error); ?>);
                      @endforeach

               @endif
         });
         @endif

         </script>
  </body>

</html>
