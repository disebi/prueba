@section('javascripts')
 <script type="text/javascript">
 function askDelete(nro){

      var form ='formdelete'+nro;
      var n = noty({
                           text        : '<div class="activity-item">  <div class="activity" style="font-size:15px; font-family: "Roboto", Helvetica, Arial, sans-serif"> Desea eliminar este registro? </div> </div>',
                           type        : 'alert',
                           dismissQueue: true,
                           timeout     : 10000,
                           layout      : 'bottomRight',
                           theme       : 'relax',
                           maxVisible  : 3,
                           animation   : {
                                           open  : 'animated bounceInRight',
                                           close : 'animated bounceOutRight',
                                           easing: 'swing',
                                           speed : 500
                                          },
                           buttons     : [
                               {addClass: 'btn btn-primary', text: 'Si', onClick: function ($noty) {
                                   $noty.close();

                                   document.getElementById(form).submit(function() {

                                       });

                                  }
                               },
                               {addClass: 'btn btn-danger', text: 'Cancelar', onClick: function ($noty) {
                                   $noty.close();

                                     }
                               }
                           ]
      });

 }
 </script>
 @append