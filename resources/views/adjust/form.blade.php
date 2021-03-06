
    {{--head--}}

        <div class="col-xs-6">
            <div class="panel panel-success">
                <div class="panel-heading">Ajuste de Stock</div>
                <div class="panel-body">
                <p>Este formulario es utilizado para realizar ajustes a las cantidades de productos en el deposito de la sucursal, para controlar las existencias puede Descargarlas </p>
                <a href="/existencias" class="btn btn-success">Existencias</a>
                </div>
            </div>
        </div><!-- /.col -->
        <div class="col-xs-3">
         @include('partials_invoice.dateTime',['stamping'=> false])
        </div><!-- /.col -->
        <div class="col-xs-3">
        @include('partials_invoice.userInfo')
        </div><!-- /.col -->


   <div class="col-xs-12">
                                   <div class="panel panel-success">
                                     <div class="panel-heading">Detalle</div>
                                         <div class="panel-body">
                                         <div class="callout callout-sutil" style="background-color:rgb(224, 248, 213) ">
                                         <h4>Seleccionar Producto</h4>
                                            <div class="row">
                                            <div class="col-xs-1">
                                                <span  style="text-align: center" id="spinner"></span>
                                            </div>
                                            <div class="col-xs-11">
                                                <div class="col-xs-4">
                                                  <div class="form-group">
                                                    <label for="products">Producto</label>

                                                    {!! Form:: select ("products",$products,null,["class"=>"form-control","id"=>"products"])!!}
                                                     </div>
                                                </div>
                                                <div class="col-xs-2">
                                                  <div class="form-group">
                                                    <label for="products">Actividad</label>

                                                    {!! Form:: select ("activity",$activity,null,["class"=>"form-control","id"=>"activity"])!!}
                                                     </div>
                                                </div>
                                                <div class="col-xs-2">
                                                    <div class="form-group">
                                                    <label for="cant">Cantidad</label>
                                                    <div class="input-group spinner"><input id="cant"  name="cant" type="text" class="form-control" value="1"><div class="input-group-btn-vertical"><button class="btn btn-default" type="button"><i class="fa fa-caret-up"></i></button><button class="btn btn-default" type="button"><i class="fa fa-caret-down"></i></button></div></div>

                                                    </div>
                                                     </div>

                                                <div class="col-xs-2">
                                                <div class="form-group">
                                                <label for="plus"> Agregar</label>
                                                <div>
                                                <a id="plus"  class="btnAdd btn btn-success btn-sm"><i class="fa fa-plus"></i></a>
                                                </div>    </div>
                                                </div>
                                            </div>
                                            </div>
                                           </div>
                                            <table  class="table table-striped">
                                           <thead >
                                            <tr>
                                            <th  class="col-md-1"  >#</th>
                                            <th class="col-md-3" >Producto</th>
                                             <th class="col-lg-2"style=" text-align: right" >Cantidad</th>
                                            <th class="col-lg-2"style=" text-align: right" >Actividad</th>


                                            <th class="col-md-2">Acciones</th>
                                            </tr>
                                           </thead>

                                           <tbody id="detail">

                                           </tbody>

                                           <tfoot id="foot">
                                           </tfoot>

                                           </table>
                                         </div>
                                     </div>
                               </div>

    {{--subtotals--}}
 <div class="col-xs-12">
    <div class="col-xs-6">
        <div class="panel panel-default">
             <div class="panel-heading">Informacion</div>
             <div class="panel-body">
                <div class="form-group">
                                                       <label for="coment">Observaciones</label>
                                                                                                            {!!Form::textarea('coment',null,['class'=>'form-control', 'style'=>'resize: none','rows'=>'5']) !!}

                                                                                                                                                                   <div class="controls">
                                                       <p>Notas acerca de la factura</p>
                                                       </div>
                                                 </div>
             </div>
        </div>
    </div>
    <div class="col-xs-6">

        {!!Form:: submit('Guardar',['class'=>'btn btn-success','id'=>'submit'])!!}
    </div>
 </div><!-- /.row -->

    <div id="inputZone"></div>
@include('partials._select2');
@section('javascripts')
<script type="text/javascript">
$("#products").select2();
$(".btnAdd").bind("click", add);
$(".btnDelete").bind("click", remove);
$(".btnEdit").bind("click", edit);


$("#clients").change(function(){
makeClients();
});





/************************************inteface functions******************************/
function spin(id){
 $('#'+id).html('<div style="text-align: center"><i class="fa fa-spinner fa-pulse fx-5-" style="color: slategray"></div>');
}


function disable(state){
$('#price').prop("disabled", state);
$('#plus').prop("disabled", state);
$('#products').prop("disabled", state);
$('#cant').prop("disabled", state);
}

function spinNumber(){
    return '<div class="input-group spinner">' +
     '<input id="cant"  name="cant" type="text" class="form-control" value="1">' +
     '<div class="input-group-btn-vertical">' +
     '<a class="btn btn-default" type="a"><i class="fa fa-caret-up"></i></a>' +
     '<a class="btn btn-default" type="a"><i class="fa fa-caret-down"></i></a>' +
     '</div>' +
     '</div>';
}


/*****************************************ABM functions************************************/
function add(){
if(!($('#cant').val()=='0') && !($('#products').val()=='0') && !($('#price').val()=='0')){
spin('spinner');
var pruebita=prove($('#products').val());
if(pruebita){
 	$('#detail').append('<tr>' +
     '<td>'+$("#products").val()+' </td>' +
     '<td>'+$('#products').find('option:selected').text()+'</td>' +

     '<td style="text-align: right">'+number_format($("#cant").val(),0,'','.')+'</td>' +
      '<td style="text-align: right">'+$("#activity").val()+'</td>' +
     '<td><a  style="padding-right: 10px" class="btn btn-success btn-sm btnEdit btnEdit'+$("#products").val()+'"><i class="fa fa-pencil"></i></a>' +
      '<a  class=" btnDelete btn btn-danger btn-sm"><i class="fa fa-trash-o"></i></a> </td></tr>');
	    $(".btnDelete").bind("click", remove);
	    $(".btnEdit"+$("#products").val()).bind("click", edit);
 		}else{
 		mensajito('error','El producto elegido ya ha sido agregado, puede eliminar y volver a registrarlo');
 		}
 		$('#spinner').html('');
}else{
 mensajito('error','Favor ingresar datos validos de su producto');
 }
}

function remove(){
$(this).parent().parent().remove(); //tr
disable(false);

}

function edit(){
disable(true);
$('.btnEdit').prop("disabled", true);
var $tr= $(this).parent().parent();

    $.when( { number:$(this).parent().parent().find("td").eq(2).html() } ).done(function(x ) {
         $tr.find("td").eq(2).html('<div class="input-group">' +
      '<div class="input-group-btn">' +
       '<a type="a" class="btn btn-default btn-mini reEdit">' +
        '<i class="fa fa-check"></i></a>' +
        '</div><input style="text-align: right" class="form-control input-mini" type="text">' +
        '</div>');
        $tr.find("td").eq(2).children().find('input').val(x.number);
        $('.btnEdit').prop("disabled", true);
        $('.btnDelete').prop("disabled", true);
        $(".reEdit").bind("click", saveEdit);
    });
}

function saveEdit(){
var $td=$(this).parent().parent().parent();
var $tr=$td.parent();
var newNumber= Number($(this).parent().parent().parent().find('input').val());
var price=0;
    if(isNaN(newNumber) || (newNumber==0)){
        mensajito('error','El numero no es valido')
    }else{
        $td.html(newNumber);
        $('.btnEdit').prop("onclick", '');
        $('.btnDelete').prop("disabled", false);

        price=Number($tr.find("td").eq(3).html().replace(/[.]/g,''))*newNumber;
        $tr.find("td").eq(5).find("p").html(number_format(price,0,'','.'));
        disable(false);

    }

}

/********************************formula functions*******************************/



function prove(id){
    var p=true;
    $('#detail > tr').each(function() {
    excent=0;
    var customerId = $(this).find("td").eq(0).html();
    if(Number(id)==Number(customerId)  ){
    p=false;
    }
    });
    return p;
}




/**********************************************inputs submits****************************************/
function getInputs(){
    $('#inputZone').html("");
    $postvalue = "";
    var cant=0;
    var activity='';
    var id=0;
    var array=[];
    $('#detail > tr').each(function() {
        id=Number($(this).find("td").eq(0).html().replace(/[.]/g,''));
        cant=Number($(this).find("td").eq(2).html().replace(/[.]/g,''));
        activity=Number($(this).find("td").eq(3).html().replace(/[.]/g,''));
        array=[id,cant,activity];
      $('#inputZone').append('<input type="hidden" name="result[]" value="' +array+ '" />');
    });
    $('#inputZone').append('<input type="hidden" name="comments" value="'+$('#msj').val()+ '" />');
}

$( "#submit" ).click(function() {
  getInputs();
  $( "#form" ).submit();
});
 </script>
@append