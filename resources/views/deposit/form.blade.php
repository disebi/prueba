 <div class="box-body">
<!-- Text input-->
    <div class="row">
        <div class="col-xs-6">
            <div class="control-group">
            {!! Form:: label ('branch_list','Sucursal:')!!}
              <div class="controls">
              <div class="col-lg-6">
               {!! Form:: select ('branch_list',$branches,null,['class'=>'form-control input-lg'])!!}
               </div>
               <div class="col-lg-6">
                 </div>
              <p class="help-block">Sucursal a que pertenece el Deposito</p>
              </div>
            </div>

            <div class="control-group">
            {!! Form:: label ('descrioption','Nombre:')!!}
            <div class="controls">
            {!! Form:: text ('description',null,['placeholder'=>'Sajonia', 'class'=>'input-medium', 'class'=>'form-control'])!!}
             <p class="help-block">Nombre del Deposito</p>
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
    $(document).ready(function() {
    $("#branch_list").select2();
    });
</script>
@append