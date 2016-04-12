
 <div class=" box-body">
<!-- Text input-->
<div class="row">
<div class="col-xs-6">


<div class="control-group">
{!! Form:: label ('description','Sucursal:')!!}
<div class="controls">
{!! Form:: text ('description',null,['placeholder'=>'Nombre Empresa', 'class'=>'input-medium', 'required'=>'','class'=>'form-control'])!!}
 <p class="help-block">Nombre de Sucursal</p>
  </div>
</div>


<!-- Text input-->
<div class="control-group">
{!! Form:: label ('direcc','Dirección:')!!}
  <div class="controls">
   {!! Form:: text ('direcc',null,['placeholder'=>'Calle 1234 c/ 2nda Calle', 'class'=>'input-xlarge','class'=>'form-control'])!!}

    <p class="help-block">Dirección de la Sucursal</p>
  </div>
</div>

<div class="control-group">
{!! Form:: label ('mail','Mail:')!!}
  <div class="controls">
   {!! Form:: text ('mail',null,['placeholder'=>'empresa@mail.com', 'class'=>'input-medium','class'=>'form-control'])!!}

     <p class="help-block">Correo electrónico de la Sucursal</p>
  </div>
</div>

<div class="control-group">
{!! Form::label ('tel','Teléfono:')!!}
  <div class="controls">
    {!! Form::text ('tel',null,['placeholder'=>'0971000000','required'=>'', 'class'=>'input-medium','class'=>'form-control'])!!}
    <p class="help-block">Telefono de la Sucursal</p>
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