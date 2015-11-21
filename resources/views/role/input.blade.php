@section('css')
 <link href="{{ asset('/css/select2.css') }}" rel="stylesheet" type="text/css" />

@append

<div class="control-group">
{!! Form:: label ('descrioption','Nombre:')!!}
<div class="controls">
{!! Form:: text ('description',null,['placeholder'=>'Gerente', 'class'=>'input-medium', 'class'=>'form-control'])!!}
 <p class="help-block">Nombre del Rol</p>
  </div>
</div>

<div class="control-group">
{!! Form:: label ('license_list','Permisos:')!!}
  <div class="controls">
  <div class="row">
  <div class="col-lg-12">
     {!! Form:: select ('license_list[]',$licenses,null,['id'=>'licenses','class'=>'form-control input-lg','multiple'])!!}
  <p class="help-block">Permisos que tendra el rol</p>
  </div>
  </div>
  </div>
</div>



@section('javascripts')
<script src="{{ URL::asset('/js/select2.full.min.js') }}"></script>
<script type="text/javascript">
$(document).ready(function() {
$("#licenses").select2();

});
 </script>
@append