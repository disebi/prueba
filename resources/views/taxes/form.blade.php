<div class="box-body">
   <div  class="form-group">
                    {!! Form:: label ('description','Descripcion:')!!}
                    {!! Form:: text ('description',null,['required'=>"",'for'=>'exampleInputEmail1','class'=>'form-control'])!!}
                    </div>

    <div  class="form-group">
                    {!! Form:: label ('valor','Valor:')!!}
                     {!! Form:: text ('valor',null,['required'=>"",'for'=>'exampleInputEmail1','class'=>'form-control'])!!}
                      </div>
</div><!-- /.box-body -->
<div class="box-footer">
                    {!!Form:: submit($submit,['class'=>'btn btn-primary'])!!}
</div>