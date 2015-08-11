
 <!-- jQuery 2.1.3 -->
    <!-- Bootstra 3.3.2 JS -->
    <script src="{{ URL::asset('/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>


    <!-- DATA TABES SCRIPT -->
    <script src="{{ URL::asset('/plugins/datatables/jquery.dataTables.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('/plugins/datatables/dataTables.bootstrap.js') }}" type="text/javascript"></script>
    <!-- SlimScroll -->
    <script src="{{ URL::asset('/plugins/slimScroll/jquery.slimscroll.min.js') }}" type="text/javascript"></script>
    <!-- FastClick -->
    <script src="{{ URL::asset('/plugins/fastclick/fastclick.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ URL::asset('/js/app.min.js') }}" type="text/javascript"></script>
    <!-- AdminLTE for demo purposes -->

    <!-- page script -->
    <script src="{{ URL::asset('/js/noty/jquery.noty.packaged.js') }}"></script>


     <script src="{{ URL::asset('/js/jquery.animsition.js') }}"></script>
      <script src="/bootstrap3-editable/js/bootstrap-editable.js"></script>


     <script type="text/javascript">

     $(document).ready(function() {



       $(".animsition").animsition({

         inClass               :   'fade-in',
         outClass              :   'fade-out',
         inDuration            :    1500,
         outDuration           :    800,
         linkElement           :   '.animsition-link',
         // e.g. linkElement   :   'a:not([target="_blank"]):not([href^=#])'
         loading               :    false,
         loadingParentElement  :   'body', //animsition wrapper element
         loadingClass          :   'animsition-loading',
         unSupportCss          : [ 'animation-duration',
                                   '-webkit-animation-duration',
                                   '-o-animation-duration'
                                 ],
         //"unSupportCss" option allows you to disable the "animsition" in case the css property in the array is not supported by your browser.
         //The default setting is to disable the "animsition" in a browser that does not support "animation-duration".

         overlay               :   false,

         overlayClass          :   'animsition-overlay-slide',
         overlayParentElement  :   'body'
       });
     });


     </script>