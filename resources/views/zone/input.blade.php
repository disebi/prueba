<div class="control-group">
{!! Form:: label ('city_list','Ciudad:')!!}
  <div class="controls">
  <div class="col-lg-6">
   {!! Form:: select ('city_list',$cities,null,['class'=>'form-control input-lg'])!!}
   </div>
   <div class="col-lg-6">
     {{--<a class="btn btn-sm btn-success" onclick="nuevaCiudad()"><i class="fa fa-plus"></i> Nueva Ciudad</a>--}}
    <a class="btn btn-sm btn-success simpleModal"  data-type="text" data-title="Nueva Ciudad"><i class="fa fa-plus"></i></a>
   </div>
  <p class="help-block">Ciudad a que pertenece la zona</p>
  </div>
</div>

<div class="control-group">
{!! Form:: label ('description','Zona:')!!}
<div class="controls">
{!! Form:: text ('description',null,['placeholder'=>'Sajonia', 'class'=>'input-medium', 'required'=>'','class'=>'form-control'])!!}
 <p class="help-block">Nombre de la Zona</p>
  </div>
</div>

<!-- Text input-->
<div class="control-group">
{!! Form:: label ('comision','Comision:')!!}
  <div class="controls">
  {!! Form:: text ('comision',null,['placeholder'=>'10%', 'class'=>'input-medium', 'required'=>'','class'=>'form-control'])!!}
    <p class="help-block">Porcentaje de comision de la zona</p>
  </div>
</div>

<!-- Text input-->
<div class="control-group">
{!! Form:: label ('km','KM:')!!}
  <div class="controls">
   {!! Form:: text ('km',null,['placeholder'=>'120', 'class'=>'input-medium', 'required'=>'','class'=>'form-control'])!!}

    <p class="help-block">Km de recorrido aproximado</p>
  </div>
</div>

<!-- Text input-->



<script type="text/javascript">


function nuevaCiudad (){


  $("#dialogCiudad").modal('show');


   }
</script>