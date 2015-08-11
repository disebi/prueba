<div class="control-group">
{!! Form:: label ('brand_list','Marca:')!!}
  <div class="controls">
  <div class="col-lg-6">
   {!! Form:: select ('brand_list',$brands,null,['class'=>'form-control input-lg'])!!}
   </div>
   <div class="col-lg-6">
     {{--<a class="btn btn-sm btn-success" onclick="modal('dialogCiudad')"><i class="fa fa-plus"></i> Nueva Ciudad</a>--}}
    <a class="btn btn-sm btn-success simpleModal" id="brandpop" data-type="text" data-title="Nueva Marca"><i class="fa fa-plus"></i></a>
   </div>
  <p class="help-block">Marca a la que pertenece el vehículo</p>
  </div>
</div>

<div class="control-group">
{!! Form:: label ('description','Vehiculo:')!!}
<div class="controls">
{!! Form:: text ('description',null,['placeholder'=>'Corola', 'class'=>'input-medium', 'required'=>'','class'=>'form-control'])!!}
 <p class="help-block">Descripcin del vehiculo</p>
  </div>
</div>

<!-- Text input-->
<div class="control-group">
{!! Form:: label ('chapa','Chapa:')!!}
  <div class="controls">
  {!! Form:: text ('chapa',null,['placeholder'=>'1234568', 'class'=>'input-medium', 'required'=>'','class'=>'form-control'])!!}
    <p class="help-block">Numero de Chapa del vehiculo</p>
  </div>
</div>

<!-- Text input-->
<div class="control-group">
{!! Form:: label ('chasis','Chasis:')!!}
  <div class="controls">
   {!! Form:: text ('chasis',null,['placeholder'=>'78954', 'class'=>'input-medium', 'required'=>'','class'=>'form-control'])!!}

    <p class="help-block">Numero de Chapa del vehiculo</p>
  </div>
</div>

<div class="control-group">
{!! Form:: label ('year','Año:')!!}
  <div class="controls">
   {!! Form:: text ('year',null,['placeholder'=>'1984', 'class'=>'input-medium', 'required'=>'','class'=>'form-control'])!!}

    <p class="help-block">Año del vehiculo</p>
  </div>
</div>

<!-- Text input-->

@section('javascripts')
<script src="{{ URL::asset('/js/select2.full.min.js') }}"></script>
<script type="text/javascript">
$("#brand_list").select2();
 </script>
@append