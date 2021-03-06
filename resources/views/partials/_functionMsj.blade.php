@section('javascripts')
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
@append
