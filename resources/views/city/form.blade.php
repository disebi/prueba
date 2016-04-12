<div class="box-body">
                    <div  class="form-group">
                    {!! Form:: label ('description','Descripcion:')!!}
                    {!! Form:: text ('description',null,['for'=>'exampleInputEmail1','class'=>'form-control'])!!}
                    </div>

                    <div class="control-group">
                                    {!! Form:: label ('branch_list','Sucursal:')!!}
                                      <div class="controls">

                                       {!! Form:: select ('branch_list',$branches,null,['class'=>'form-control input-lg'])!!}


                                      <p class="help-block">Sucursal que controla la ciudad</p>
                                      </div>
                                    </div>

                   <div class="form-group">
                                    {!!Form:: submit($submit,['class'=>'btn btn-primary'])!!}

                   </div>
                </div><!-- /.box-body -->

@include('partials._select2')
 @section('javascripts')
   <script type="text/javascript">
      $("#branch_list").select2();
    </script>
 @append

