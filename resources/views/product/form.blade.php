 <div class="box-body">
<!-- Text input-->
<div class="col-md-12">

<div class="control-group">
{!! Form:: label ('desciption','Producto:')!!}
<div class="controls">
{!! Form:: text ('description',null,['placeholder'=>'Espanta Ya', 'class'=>'input-medium', 'class'=>'form-control'])!!}
 <p class="help-block">Nombre del Producto</p>
  </div>
</div>



<div class="control-group">
{!! Form:: label ('provider_list','Proveedor:')!!}
  <div class="controls">

   {!! Form:: select ('provider_list',$providers,null,['class'=>'form-control'])!!}
   <p class="help-block">Proveedor del Producto</p>

   </div>
</div>


<div class="control-group">
{!! Form:: label ('line_list','Linea:')!!}
  <div class="controls">
    <div class="col-lg-6">
   {!! Form:: select ('line_list',$lines,null,['class'=>'form-control input-lg'])!!}
    </div>
     <div class="col-lg-6" style="padding-top: 15px">
    <a class="btn btn-sm btn-success simpleModal" id="linepop" data-type="text" data-title="Nueva Linea"><i class="fa fa-plus"></i></a>
 </div>
  <p class="help-block">Linea a que pertenece el producto</p>
  </div>
</div>

<div class="control-group">
{!! Form:: label ('presentation_list','Presentacion:')!!}
  <div class="controls">
  <div class="col-lg-6" >
   {!! Form:: select ('presentation_list',$presentations,null,['class'=>'form-control input-lg'])!!}
   </div>
   <div class="col-lg-6" style="padding-top: 15px">
     {{--<a class="btn btn-sm btn-success" onclick="modal('dialogCiudad')"><i class="fa fa-plus"></i> Nueva Ciudad</a>--}}
    <a class="btn btn-sm btn-success simpleModal" id="presentationpop" data-type="text" data-title="Nueva Presentacion"><i class="fa fa-plus"></i></a>
   </div>
  <p class="help-block">Presentacion a que pertenece el producto</p>
  </div>
</div>

<div class="control-group">
{!! Form:: label ('contenido','Contenido:')!!}
<div class="controls">
{!! Form:: text ('contenido',null,['placeholder'=>'50', 'class'=>'input-medium', 'class'=>'form-control'])!!}
 <p class="help-block">Precio de venta del producto</p>
  </div>
</div>

<div class="control-group">
{!! Form:: label ('unity_list','Unidad de media:')!!}
  <div class="controls">
  <div class="col-lg-6">
   {!! Form:: select ('unity_list',$unities,null,['class'=>'form-control input-lg'])!!}
   </div>
   <div class="col-lg-6" style="padding-top: 15px">
     <a class="btn btn-sm btn-success simpleModal" id="unitypop" data-type="text" data-title="Nueva Unidad de Medida"><i class="fa fa-plus"></i></a>
   </div>
  <p class="help-block">Unidad del contenido</p>
  </div>
</div>




<div class="control-group">
{!! Form:: label ('aroma_list','Aroma:')!!}
  <div class="controls">
  <div class="col-lg-6">
   {!! Form:: select ('aroma_list',$aromas,null,['class'=>'form-control input-lg'])!!}
   </div>
   <div class="col-lg-6" style="padding-top: 15px">
     {{--<a class="btn btn-sm btn-success" onclick="modal('dialogCiudad')"><i class="fa fa-plus"></i> Nueva Ciudad</a>--}}
    <a class="btn btn-sm btn-success simpleModal" id="aromapop" data-type="text" data-title="Nuevo aroma"><i class="fa fa-plus"></i></a>
   </div>
  <p class="help-block">Aroma</p>
  </div>
</div>

<div class="control-group">
{!! Form:: label ('compra','Precio de Compra:')!!}
<div class="controls">
{!! Form:: text ('compra',null,['placeholder'=>'34000', 'class'=>'input-medium', 'class'=>'form-control'])!!}
 <p class="help-block">Precio de compra del producto</p>
  </div>
</div>

<div class="control-group">
{!! Form:: label ('venta','Precio de Venta:')!!}
<div class="controls">
{!! Form:: text ('venta',null,['placeholder'=>'56000', 'class'=>'input-medium', 'class'=>'form-control'])!!}
 <p class="help-block">Precio de venra del producto</p>
  </div>
</div>

<div class="control-group">
{!! Form:: label ('peso','Peso del producto en gr.:')!!}
<div class="controls">
{!! Form:: text ('peso',null,['placeholder'=>'1200,3', 'class'=>'input-medium', 'class'=>'form-control'])!!}
 <p class="help-block">Peso del producto en gramos</p>
  </div>
</div>

<div class="control-group">
{!! Form:: label ('tax_list','Impuesto:')!!}
  <div class="controls">
  <div class="col-lg-6">
   {!! Form:: select ('tax_list',$taxes,null,['class'=>'form-control input-lg'])!!}
   </div>
   <p class="help-block">Impuesto del Producto</p>
  </div>
</div>

<div class="control-group" style="padding-top: 20px">
{!! Form:: label ('min','Minima Cantidad en Deposito:')!!}
<div class="controls">
{!! Form:: text ('min',null,['placeholder'=>'800', 'class'=>'input-medium', 'class'=>'form-control'])!!}
 <p class="help-block">Minima cantidad del producto | Quiebre</p>
  </div>
</div>

</div>

<div class="box-footer">
<div class="col-md-12">
<div class="control-group">
    {!!Form:: submit($submit,['class'=>'btn btn-primary'])!!}
</div>
</div>
</div>
</div>

@include('partials._select2')
@section('javascripts')
<script type="text/javascript">
$("#unity_list").select2();
$("#tax_list").select2();
$("#provider_list").select2();
$("#aroma_list").select2();
$("#presentation_list").select2();
$("#line_list").select2();

 </script>
@append
    @include('partials._popout')

    @include('simpleRef.simple_referential_popout',['comboBox'=>'unity_list','urlmodal'=>'/unidades','idpop'=>'unitypop','controller'=>'unity'])
    @include('simpleRef.simple_referential_popout',['comboBox'=>'line_list','urlmodal'=>'/lineas','idpop'=>'linepop','controller'=>'line'])
    @include('simpleRef.simple_referential_popout',['comboBox'=>'aroma_list','urlmodal'=>'/aromas','idpop'=>'aromapop','controller'=>'aroma'])
    @include('simpleRef.simple_referential_popout',['comboBox'=>'presentation_list','urlmodal'=>'/presentaciones','idpop'=>'presentationpop','controller'=>'presentation'])


