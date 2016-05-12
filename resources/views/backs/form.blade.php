@section('css')
 <link href="{{ asset('/css/select2.css') }}" rel="stylesheet" type="text/css" />
 <link href="{{ asset('/plugins/datepicker/datepicker3.css') }}" rel="stylesheet" type="text/css" />
@append


<div class="panel panel-success">
<div class="panel-body">
<p><b>Tanque: </b>{{$out->tanque}}</p>
<p><b>Km: </b>{{$out->km}}</p>
<p><b>Driver: </b>{{$out->driver->name.' '.$out->driver->last_name}}</p>
<p><b>Vehiculo: </b>{{$out->drive->description}}</p>
</div>
</div>

 {!! Form:: hidden ('out_id',$out->id)!!}
<!--km Input Begins-->
<div class="control-group">
{!! Form:: label ('km','Kilometraje:')!!}
  <div class="controls">
  {!! Form:: text ('km',null,['placeholder'=>'345,4', 'class'=>'input-medium', 'required'=>'','class'=>'form-control'])!!}
    <p class="help-block"></p>
  </div>
</div>
<!-- km Input Ends-->

<!--tanque Input Begins-->
<div class="control-group">
{!! Form:: label ('tanque','Tanque:')!!}
  <div class="controls">
  {!! Form:: text ('tanque',null,['placeholder'=>'', 'class'=>'input-medium', 'required'=>'','class'=>'form-control'])!!}
    <p class="help-block"></p>
  </div>
</div>
<!-- tanque Input Ends-->

<!--comments Input Begins-->
<div class="control-group">
{!! Form:: label ('comments','Comentario:')!!}
  <div class="controls">
  {!! Form:: textarea ('comments',null,['placeholder'=>'', 'class'=>'input-medium', 'rows'=>'5','required'=>'','class'=>'form-control'])!!}
    <p class="help-block"></p>
  </div>
</div>
<!-- comments Input Ends-->


<div class="control-group">
    {!!Form:: submit($submit,['class'=>'btn btn-primary'])!!}
</div>

