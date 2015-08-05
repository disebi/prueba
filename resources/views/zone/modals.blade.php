
 <div id="dialogZone" class="modal fade">
<div class="modal-dialog ">
               <div class="modal-content">
                 <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
              <h4 class="modal-title">Nueva Zona</h4>
                </div>
                 <div class="modal-body">
                {!! Form:: open(array("url"=>"/zonas"))!!}

                   @include("zone.input")


                 </div>
                <div class="modal-footer">
                         {!!Form:: submit('Guardar',['class'=>'btn btn-primary'])!!}

                         {!!Form::close()!!}
                    <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Cancelar</button>

                  </div>
               </div>
            </div>


</div>