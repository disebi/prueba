

                <div class="box-body">

                    <div  class="form-group">
                    {!! Form:: label ('description','Descripcion:')!!}
                    <div class="row">
                    <div class="col-lg-4">
                    {!! Form:: text ('description',null,['class'=>'form-control'])!!}
                    <p class="help-block">Nombre del permiso</p>
                    </div>
                    <div class="col-lg-2 pull-left">
                    {!! Form:: select ('partials',$partials,$array,['class'=>'form-control', 'id'=>'partials'])!!}
                    <p class="help-block">Nombre del acceso</p>
                    </div>
                    </div>

                     <div  class="form-group">
                         {!! Form:: label ('info','Informacion:')!!}
                     <div class="row">
                     <div class="col-lg-6">
                     {!! Form:: textarea ('info',null,['class'=>'form-control'])!!}
                     <p class="help-block">Breve descripcion del permiso</p>
                     </div>
                         </div>
                        </div>
                </div><!-- /.box-body -->

                <div class="box-footer">
                    {!!Form:: submit($submit,['class'=>'btn btn-primary'])!!}

                </div>

@section('javascripts')
<script src="{{ URL::asset('/js/select2.full.min.js') }}"></script>
<script type="text/javascript">
$("#partials").select2();
 </script>
@append