 <div class="box-body">
<!-- Text input-->
<div class="row">
<div class="col-xs-6">
<div class="control-group">
{!! Form:: label ('city_list','Ciudad:')!!}
  <div class="controls">
  <div class="col-lg-6">
   {!! Form:: select ('city_list',$cities,null,['class'=>'form-control input-lg'])!!}
   </div>
   <div class="col-lg-6">
  </div>
  <p class="help-block">Ciudad a que pertenece la zona</p>
  </div>
</div>


<div class="control-group">
{!! Form:: label ('description','Zona:')!!}
<div class="controls">
{!! Form:: text ('description',null,['placeholder'=>'Sajonia', 'class'=>'input-medium', 'class'=>'form-control'])!!}
 <p class="help-block">Nombre de la Zona</p>
  </div>
</div>

<!-- Text input-->
<div class="control-group">
{!! Form:: label ('comision','Comision:')!!}
  <div class="controls">
  {!! Form:: text ('comision',null,['placeholder'=>'10%', 'class'=>'input-medium', 'class'=>'form-control'])!!}
    <p class="help-block">Porcentaje de comision de la zona</p>
  </div>
</div>

<!-- Text input-->
<div class="control-group">
{!! Form:: label ('km','KM:')!!}
  <div class="controls">
   {!! Form:: text ('km',null,['placeholder'=>'120', 'class'=>'input-medium', 'class'=>'form-control'])!!}

    <p class="help-block">Km de recorrido aproximado</p>
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
$("#city_list").select2();
 </script>
@append
