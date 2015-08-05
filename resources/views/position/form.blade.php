

 <div class=" box-body">
<!-- Text input-->
<div class="row">
<div class="col-xs-6">


<div class="control-group">
{!! Form:: label ('description','Cargo:')!!}
<div class="controls">
{!! Form:: text ('description',null,['placeholder'=>'Nombre Cargo', 'class'=>'input-medium', 'required'=>'','class'=>'form-control'])!!}
 <p class="help-block">Nombre del Cargo</p>
  </div>
</div>

<!-- Text input-->
<div class="control-group">
{!! Form:: label ('monto','Monto Sueldo:')!!}
  <div class="controls">
  {!! Form::text ('monto',null,['placeholder'=>'1850000', 'class'=>'input-medium', 'required'=>'','class'=>'form-control'])!!}
    <p class="help-block">Sueldo acorde al cargo</p>
  </div>
</div>

<!-- Text input-->
<div class="control-group">
{!! Form:: label ('periodo','Periodo:')!!}
  <div class="controls">
   {!! Form:: select ('periodo',$array,$edit,['class'=>'input-medium','class'=>'form-control'])!!}
  <p class="help-block">Periodo de cobro</p>
  </div>
</div>

<!-- Text input-->


</div>



</div>

<div class="box-footer">
<div class="control-group">


    {!!Form:: submit($submit,['class'=>'btn btn-primary'])!!}

</div>

</div>
</div>