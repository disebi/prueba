
<div id="dialogZone" class="modal fade">
    <div class="modal-dialog ">
        <div class="modal-content">
                 <div class="modal-header">
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                     <h4 class="modal-title">Nuevo Proveedor</h4>
                </div>
                 <div class="modal-body">
                  @include('provider.input',['kmt'=>'kmModal','comisiont'=>'comisionModal','descriptiont'=>'descriptionModal'])

                 </div>
                <div class="modal-footer">
                <button type="button" onclick="sendZone()" class="btn btn-primary pull-right" data-dismiss="modal">Guardar</button>
                <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Cancelar</button>
                  </div>
               </div>
            </div>
</div>

<script type="text/javascript">


         function sendZone(){
         var token= '{{csrf_token()}}';
         var data={_token:token,
                    description:document.getElementById("descriptionModal").value,
                    km:document.getElementById("kmModal").value,
                    comision:document.getElementById("comisionModal").value,
                    city_id:document.getElementById("city_list").value
                    };

         $.ajax({
                     url: '{{ action("ReferentialControllers\ZoneController@storeModal") }}',
                     type: 'POST',
                     data:data})
                     .fail(function (data2){
                       console.log(data2.responseJSON.km);
                      $.each(data2.responseJSON, function(i,item){
                               mensajito('error',item[0]);
                     });
                    })
                     .success (function (data2){
                     $("#zone_list").html("");
                     $.each(data2, function(i,item){
                     $("#zone_list").append("<option value="+item.id+">"+item.description+"</option>");
                     });
                     var value=data2[data2.length-1].description;


                     mensajito('success','El registro fue guardado con exito');

                 });
          }
         </script>