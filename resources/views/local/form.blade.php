 <div class="box-body">
<!-- Text input-->
 <div class="row">
        <div class="col-xs-6">
          <div class="control-group">
          <div class="row">
            <div class="col-lg-12">
                           {!! Form:: label ('business_list','Rubro:')!!}
                          </div>
          <div class="controls">
          <div class="col-lg-6">
          {!! Form:: select ('business_list',$business,null,['class'=>'form-control input-small'])!!}
          </div>
          <div class="col-lg-6">
          <a class="btn btn-sm btn-success simpleModal" id="rubropop" data-type="text" data-title="Nuevo Rubro"><i class="fa fa-plus"></i></a>
          </div>
          </div>
          </div>
        </div>

        <div class="control-group">
            <div class="row">
            <div class="col-lg-12">
            {!! Form:: label ('zone_list','Zona:')!!}
              </div>
            <div class="controls">
             <div class="row">
             </div>
               <div class="col-lg-6">
                {!! Form:: select ('zone_list',$zones,null,['class'=>'input-medium form-control'])!!}
                 <p class="help-block">Zona a la que pertenece el local</p>
                 </div>
                 <div class="col-lg-6" style="padding-bottom: 40px">
                    <a class="btn btn-sm btn-success" onclick="nuevaZona()"><i class="fa fa-plus"></i></a>
                    </div>
                 </div>
                 </div>
        </div>
        <div class="control-group">
        {!! Form:: label ('description','Local:')!!}
        <div class="controls">
        {!! Form:: text ('description',null,['placeholder'=>'Luisa', 'class'=>'input-medium', 'required'=>'','class'=>'form-control'])!!}
         <p class="help-block">Nombre del Local</p>
          </div>
        </div>
        <div class="control-group">
        {!! Form:: label ('direcc','Direccion del Local:')!!}
          <div class="controls">
          {!! Form:: text ('direcc',null,['placeholder'=>'Carlos. A. Lopez 123 c/ Paiva', 'class'=>'input-medium', 'required'=>'','class'=>'form-control'])!!}
            <p class="help-block">Direccion del Local</p>
          </div>
        </div>
        <!-- Text input-->
        <div class="control-group">
        {!! Form:: label ('ruc','RUC:')!!}
          <div class="controls">
          {!! Form:: text ('ruc',null,['placeholder'=>'12345678-9', 'class'=>'input-medium', 'required'=>'','class'=>'form-control'])!!}
            <p class="help-block">RUC que utiliza el local</p>
          </div>
        </div>
</div>

<div class="col-xs-6">
         <div class="control-group">
                {!! Form:: label ('razon','Razon Social:')!!}
                  <div class="controls">
                   {!! Form:: text ('razon',null,['placeholder'=>'Luisa S.A.', 'class'=>'input-medium', 'required'=>'','class'=>'form-control'])!!}

                    <p class="help-block">Razon Social a utilizar en la factura</p>
                  </div>
                </div>
        <div class="control-group">
        {!! Form:: label ('nombre','Nombre del Dueño:')!!}
        <div class="controls">
        {!! Form:: text ('nombre',null,['placeholder'=>'Luisa', 'class'=>'input-medium', 'required'=>'','class'=>'form-control'])!!}
         <p class="help-block">Nombre del Dueño</p>
          </div>
        </div>

        <!-- Text input-->
        <div class="control-group">
        {!! Form:: label ('apellido','Apellido del Dueño:')!!}
          <div class="controls">
          {!! Form:: text ('apellido',null,['placeholder'=>'Gonzalez', 'class'=>'input-medium', 'required'=>'','class'=>'form-control'])!!}
            <p class="help-block">Apellido del Dueño</p>
          </div>
        </div>

        <!-- Text input-->
        <div class="control-group">
        {!! Form:: label ('tel','Telefono:')!!}
          <div class="controls">
           {!! Form:: text ('tel',null,['placeholder'=>'123-456', 'class'=>'input-medium', 'required'=>'','class'=>'form-control'])!!}

            <p class="help-block">Razon Social a utilizar en la factura</p>
          </div>
        </div>

        <div class="col-lg-6" style="padding-top: 10px">
        <div class="box-footer">
        <div class="control-group">
           {!!Form:: submit($submit,['class'=>'btn btn-lg btn-primary'])!!}
        </div>
        </div>
        </div>
 </div>
 </div>
</div>

@include('zone.modals')
<script type="text/javascript">
function nuevaZona (){
   $("#dialogZone").modal('show');
   }
</script>

@section('javascripts')
@include('simpleRef.simple_referential_popout',['comboBox'=>'business_list','urlmodal'=>'/rubros','idpop'=>'rubropop','controllermodal'=>'\Business'])
@include('simpleRef.simple_referential_popout',['comboBox'=>'city_list','urlmodal'=>'/ciudad','idpop'=>'citypop','controllermodal'=>'\City'])
@append