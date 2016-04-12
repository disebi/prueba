<div class="col-xs-6">

<div class="control-group">
{!! Form:: label ('prov_des','Proveedor:')!!}
<div class="controls">
{!! Form:: text ('prov_des',null,['placeholder'=>'Nombre Empresa', 'class'=>'input-medium', 'required'=>'','class'=>'form-control'])!!}
 <p class="help-block">Nombre de Proveedor</p>
  </div>
</div>

<!-- Text input-->
<div class="control-group">
{!! Form:: label ('prov_razon','Razon Social:')!!}
  <div class="controls">
  {!! Form:: text ('prov_razon',null,['placeholder'=>'Razon Social', 'class'=>'input-medium', 'required'=>'','class'=>'form-control'])!!}
    <p class="help-block">Razon Social utilizada en la Factura</p>
  </div>
</div>

<!-- Text input-->
<div class="control-group">
{!! Form:: label ('prov_ruc,'RUC:')!!}
  <div class="controls">
   {!! Form:: text ('prov_ruc,null,['placeholder'=>'8005412-7', 'class'=>'input-medium', 'required'=>'','class'=>'form-control'])!!}

    <p class="help-block">Ruc a utilizar en la Factura</p>
  </div>
</div>

<!-- Text input-->
<div class="control-group">
{!! Form:: label ('prov_direcc,'Dirección:')!!}
  <div class="controls">
   {!! Form:: text ('prov_direcc,null,['placeholder'=>'Calle 1234 c/ 2nda Calle', 'class'=>'input-xlarge','class'=>'form-control'])!!}

    <p class="help-block">Dirección de la Empresa</p>
  </div>
</div>


</div>


<div class="col-xs-6">
<!-- Text input-->
<div class="control-group">
{!! Form:: label ('prov_mail','Mail:')!!}
  <div class="controls">
   {!! Form:: text ('prov_mail',null,['placeholder'=>'empresa@mail.com', 'class'=>'input-medium','class'=>'form-control'])!!}

     <p class="help-block">Correo electrónico de la empresa</p>
  </div>
</div>

<!-- Text input-->
<div class="control-group">
{!! Form:: label ('prov_tel','Teléfono:')!!}
  <div class="controls">
    {!! Form:: text ('prov_tel',null,['placeholder'=>'0971000000','required'=>'', 'class'=>'input-medium','class'=>'form-control'])!!}

    <p class="help-block">Telefono del Proveedor</p>
  </div>
</div>

<!-- Text input-->
<div class="control-group">
{!! Form:: label ('prov_web','Web:')!!}
  <div class="controls">
   {!! Form:: text ('prov_web',null,['placeholder'=>'www.empresa.com', 'class'=>'input-medium','class'=>'form-control'])!!}
    <p class="help-block">Página Web de la Empresa</p>
  </div>
</div>
  </div><!-- /.box-body -->