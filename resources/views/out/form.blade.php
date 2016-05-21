

<div class="col-lg-6">
    <div class="control-group">
         {!! Form:: label ('driver_id','Conductor:')!!}
           <div class="controls">

              {!! Form:: select ('driver_id',$staff,null,['class'=>'form-control input-lg','id'=>'driver_id'])!!}
                 <p class="help-block">Conductor</p>
            </div>
         </div>
    <div class="control-group">
         {!! Form:: label ('drive_id','Vehiculo:')!!}
           <div class="controls">

              {!! Form:: select ('drive_id',$drives,null,['class'=>'form-control input-lg','id'=>'drive_id'])!!}
                 <p class="help-block">Razon</p>
            </div>
         </div>

@if(isset($model))
<div class="control-group">
     {!! Form:: label ('razon','Razon:')!!}
       <div class="controls">
        @if($model->razon ==0)
         <span class="label label-warning"> Otro</span>
         @elseif($model->razon=1)
         <span class="label label-success"> Entrega  <a href="/remisiones/{{$model->razon_id}}">Nro {{$model->razon_id}}</a></span>
        @elseif($model->razon=2)
         <span class="label label-info"> Remision  <a href="/remisiones/{{$model->razon_id}}">Nro {{$model->razon_id}}</a></span>
         @endif
        </div>
 </div>
@else
    <div class="control-group">
     {!! Form:: label ('razon','Razon:')!!}
       <div class="controls">

          {!! Form:: select ('razon',$razon,null,['class'=>'form-control input-lg','id'=>'razon'])!!}
             <p class="help-block">Razon</p>
        </div>
     </div>

     <div class="control-group" id="listado" style="display: none">
     {!! Form:: label ('razon_id','Lista:')!!}
       <div class="controls">

          {!! Form:: select ('razon_id',[],null,['class'=>'form-control input-lg','id'=>'razon_id'])!!}
             <p class="help-block">Listado</p>
        </div>
     </div>
@endif
</div>
<div class="col-lg-6">

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
</div>

@include('partials._select2')
 @section('javascripts')
   <script type="text/javascript">


      $("#drive_id").select2();
      $("#driver_id").select2();
      $("#razon").select2();


      $("#razon").on('change', function(e) {
          if($(this).val()=="1"){
           $("#razon").prop("disabled", true);
          $.post( "/getRazons", {_token:'{{csrf_token()}}', razon:$(this).val() },function( response ) {
               $("#listado").show();
               $('#razon_id').select2();
               $("#razon_id").html('');
                  $.each(response, function(i,item){
                          //introducimos los option del Json obtenido
                       $("#razon_id").append("<option value="+item.id+">Entrega Nro. "+item.id+" a <b> "+item.description+"</b> <br/>" +
                        " Creado "+item.created_at+"</option>");
                   });
                   $("#razon_id").val(response[0]['id']).trigger("change");
                   $("#razon").prop("disabled", false);
           });
          }

          if($(this).val()=="2"){
                    $("#razon").prop("disabled", true);
                    $.post( "/getRazons", {_token:'{{csrf_token()}}', razon:$(this).val() },function( response ) {
                         $("#listado").show();
                                      $('#razon_id').select2();
                                      $("#razon_id").html('');
                            $.each(response, function(i,item){
                                    //introducimos los option del Json obtenido
                                 $("#razon_id").append("<option value="+item.id+">Remision a <b> "+item.description+"</b> <br/>" +
                                  " Creado "+item.created_at+" por "+item.name+" "+item.last_name+"</option>");
                             });
                              $("#razon_id").val(response[0]['id']).trigger("change");
                                                 $("#razon").prop("disabled", false);
                     });
                    }

                    if($(this).val()=="0"){
                            $("#listado").hide();
       }
      });



    </script>
 @append