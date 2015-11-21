<div class="control-group">
{!! Form:: label ('branch_list','Sucursal:')!!}
  <div class="controls">
  <div class="col-lg-6">
   {!! Form:: select ('branch_list',$branches,null,['class'=>'form-control input-lg'])!!}
   </div>
   <div class="col-lg-6">
     </div>
  <p class="help-block">Sucursal a que pertenece el Deposito</p>
  </div>
</div>

<div class="control-group">
{!! Form:: label ('descrioption','Nombre:')!!}
<div class="controls">
{!! Form:: text ('description',null,['placeholder'=>'Sajonia', 'class'=>'input-medium', 'class'=>'form-control'])!!}
 <p class="help-block">Nombre del Deposito</p>
  </div>
</div>

<!-- Text input-->

<!-- Text input-->

<!-- Text input-->

@section('javascripts')
<script src="{{ URL::asset('/js/select2.full.min.js') }}"></script>
<script type="text/javascript">
$(document).ready(function() {
$("#branch_list").select2();

});
 </script>
@append