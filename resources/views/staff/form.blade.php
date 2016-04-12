 <div class="box-body">
<!-- Text input-->
<div class="row">

<div class="col-md-6">
<div class="control-group">
{!! Form:: label ('branch_list','Sucursal:')!!}
  <div class="controls">
  <div class="col-lg-6">
   {!! Form:: select ('branch_list',$branches,null,['class'=>'form-control input-lg'])!!}
   </div>

  <p class="help-block">Sucursal a que pertenece el empleado</p>
  </div>
</div>

<div class="control-group">
{!! Form:: label ('position_list','Cargo:')!!}
  <div class="controls">
  <div class="col-lg-6">
   {!! Form:: select ('position_list',$cargos,null,['class'=>'form-control input-lg'])!!}
   </div>

  <p class="help-block">Cargo a que pertenece el empleado</p>
  </div>
</div>

<div class="control-group">
{!! Form:: label ('role_list','Role:')!!}
  <div class="controls">
  <div class="col-lg-6">
   {!! Form:: select ('role_list',$roles,isset($user->role_id) ? $user->role_id : null,['class'=>'form-control input-lg'])!!}
   </div>

  <p class="help-block">Rol a que pertenece el empleado</p>
  </div>
</div>


<div class="control-group">
{!! Form:: label ('name','Nombre:')!!}
<div class="controls">
{!! Form:: text ('name',null,['placeholder'=>'Juan', 'class'=>'input-medium', 'class'=>'form-control'])!!}
 <p class="help-block">Nombre del empleado</p>
  </div>
</div>

<div class="control-group">
{!! Form:: label ('last_name','Apellido:')!!}
<div class="controls">
{!! Form:: text ('last_name',null,['placeholder'=>'Arguello', 'class'=>'input-medium', 'class'=>'form-control'])!!}
 <p class="help-block">Apellido del empleado</p>
  </div>
</div>

<div class="control-group">
{!! Form:: label ('ci','CI:')!!}
<div class="controls">
{!! Form:: text ('ci',null,['placeholder'=>'4.123.456', 'class'=>'input-medium', 'class'=>'form-control'])!!}
 <p class="help-block">CI del empleado</p>
  </div>
</div>

<div class="control-group">
{!! Form:: label ('birth_date','Fecha de Naciomiento:')!!}
<div class="controls">
    <div class="input-group date">
    {!! Form:: text ('birth_date',null,[ 'class'=>'form-control'])!!}
      <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
    </div>
 <p class="help-block">Fecha de nacimiento del empleado</p>
  </div>
</div>
</div>
<div class="col-md-6">



<div class="control-group">
{!! Form:: label ('direcc','Direccion:')!!}
<div class="controls">
{!! Form:: text ('direcc',null,['placeholder'=>'Tte Prieto 123', 'class'=>'input-medium', 'class'=>'form-control'])!!}
 <p class="help-block">Direccion del empleado</p>
  </div>
</div>

<div class="control-group">
{!! Form:: label ('tel','Telefono:')!!}
<div class="controls">
{!! Form:: text ('tel',null,['placeholder'=>'0971 111 111', 'class'=>'input-medium', 'class'=>'form-control'])!!}
 <p class="help-block">Telefono del empleado</p>
  </div>
</div>

<div class="control-group">
{!! Form:: label ('nick','Nick:')!!}
<div class="controls">
{!! Form:: text ('nick', isset($user->name) ? $user->name : null,['placeholder'=>'cthulhu777',  'class'=>'form-control'])!!}
 <p class="help-block">Nick del empleado</p>
  </div>
</div>

<div class="control-group">
{!! Form:: label ('email','Mail:')!!}
<div class="controls">
{!! Form:: text ('email',isset($user->email) ? $user->email : null,['placeholder'=>'mail@mail.com',  'class'=>'form-control'])!!}
 <p class="help-block">Correo del empleado</p>
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
@include('partials._date')
@include('partials._select2')

@section('javascripts')
<script type="text/javascript">
$("#branch_list").select2();
$("#role_list").select2();
$("#position_list").select2();
    $('.input-group.date').datepicker({
        startView: 2,
        language: "es",
        format: "yyyy-mm-dd"
    });
 </script>
@append