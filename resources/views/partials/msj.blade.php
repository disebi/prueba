 @if (\Session::has('message'))
      @include('partials.functionMsj');
 @endif

 @if($errors->any())
          <script type="text/javascript">
                     function mensajitoError (textm) {
                         var n = noty({
                             text        : '<div class="activity-item">  <div class="activity" style="font-size:15px; font-family: "Roboto", Helvetica, Arial, sans-serif">'+textm+' </div> </div>',
                             type        : 'error',
                             dismissQueue: true,
                             timeout     : 10000,
                             closeWith   : ['click'],
                             layout      : 'bottomRight',
                             theme       : 'bootstrapTheme',
                             maxVisible  : 3,
                             animation   : {
                                 open  : 'animated bounceInRight',
                                 close : 'animated bounceOutRight',
                                 easing: 'swing',
                                 speed : 500
                             }
                         });}
                @foreach($errors->all() as $error)
                     $(document).ready(function() {
                         mensajitoError(<?php echo json_encode($error); ?>);
                     })
                 @endforeach
            </script>
 @endif


