<div id="{{$id}}" class="popuptabarea" xmlns="http://www.w3.org/1999/html">
<div class="popover-content ">
               <div class="modal-content">
                 <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <h4 class="modal-title">Nueva {{$modalreferential}}</h4>
                </div>
                 <div class="modal-body">

                                        <div class="box-body">

                                                       <div  class="form-group">
                                                       <label for="description">Descripcion:</label>
                                                       <input for="exampleInputEmail1" required="" id="{{$modalreferential}}Modal" class="form-control" name="description" type="text">
                                                       </div>
                                        </div><!-- /.box-body -->


                                        <div class="modal-footer">
                                                 <button class="btn btn-primary" onclick="sendM()"  type="submit" data-dismiss="modal">Guardar</button>


                                            <button type="button"  class="btn btn-default pull-right" data-dismiss="modal">Cancelar</button>
                                        </div>
               </div>
            </div>
</div>
</div>


<script type="text/javascript">

         function modal (modal){ $("#"+modal).modal('show'); }
         function sendM(){
         var token= '{{csrf_token()}}';

         var data={_token:token,
                    description:document.getElementById("{{$modalreferential}}Modal").value,
                    modal:'t'};
         $.ajax({
                     url: '{{ action("ReferentialControllers".$controllermodal."Controller@store") }}',
                     type: 'POST',
                     data:data}).done (function (data2){

                     if(data2==0){
                          mensajito('error','El registro que intenta ingresar ya existe');
                     }else{

                         $("#"+"{{$comboBox}}").html("");
                         //recorremos todas las filas del resultado del proceso que obtenemos en Json
                         $("#"+"{{$comboBox}}").append("<option value=0>Seleccionar</option>");
                             $.each(data2, function(i,item){
                         //introducimos los option del Json obtenido
                            $("#"+"{{$comboBox}}").append("<option value="+item.id+">"+item.description+"</option>");
                             });

                         mensajito('El registro fue guardado con exito','success');
                     }
                 });
          }
         </script>