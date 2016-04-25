 <div class="box-body">
<!-- Text input-->
<div class="row">
<div class="col-xs-6">
@if(isset($model))
<div class="control-group">
<p>Vendedor</p>
<div class="controls">

 <h3 class="help-block title"> {{$model->name.' '.$model->last_name}}</h3>
  </div>
{!! Form:: hidden ('staff_list',$model->staff_id,['class'=>'form-control input-small'])!!}

@else

<div class="control-group">
{!! Form:: label ('staff_list','Vendedor:')!!}
<div class="controls">
 {!! Form:: select ('staff_list',$staff,null,['class'=>'form-control input-small','id'=>'staff'])!!}
 <p class="help-block">Seleccione un Vendedor</p>
  </div>
@endif

</div>

<div class="control-group">
{!! Form:: label ('zones_list','Zonas:')!!}
  <div class="controls">
  <div class="row">
  <div class="col-lg-12">
     {!! Form:: select ('zones_list[]',$zones,null,['id'=>'zones','class'=>'form-control input-lg','multiple'])!!}
  <p class="help-block">Permisos que tendra el rol</p>
  </div>
  </div>
  </div>
</div>
</div>
</div>
<div class="box-footer">
<div class="control-group">
    {!!Form:: submit($submit,['class'=>'btn btn-primary'])!!}

</div>

</div>
</div>

@include('partials._select2')
@section('javascripts')
<script type="text/javascript">
$(document).ready(function() {
$("#zones").select2();
$("#staff").select2();
});
 </script>
@append