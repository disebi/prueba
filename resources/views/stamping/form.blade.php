<div class="box-body">
                    <div  class="form-group">
                    {!! Form:: label ('from','Desde:')!!}
                    {!! Form:: text ('from',null,['class'=>'form-control'])!!}
                    </div>
                    <div  class="form-group">
                    {!! Form:: label ('to','Hasta:')!!}
                    {!! Form:: text ('to',null,['class'=>'form-control'])!!}
                    </div>

                    <div class="control-group">
                    {!! Form:: label ('do','Fecha de Naciomiento:')!!}
                    <div class="controls">
                        <div class="input-group date">
                        {!! Form:: text ('do',null,[ 'class'=>'form-control'])!!}
                          <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                        </div>
                     <p class="help-block">Fecha de vencimiento del timbrado</p>
                      </div>
                    </div>


                   <div class="form-group">
                                    {!!Form:: submit($submit,['class'=>'btn btn-primary'])!!}

                   </div>
                </div><!-- /.box-body -->
@include('partials._date')
@include('partials._select2')
 @section('javascripts')
   <script type="text/javascript">
      $("#branch_list").select2();
      $('.input-group.date').datepicker({
              startView: 2,
              language: "es",
              format: "yyyy-mm-dd"
          });
    </script>
 @append



