@section('css')
 <link href="{{ asset('/css/select2.css') }}" rel="stylesheet" type="text/css" />
 <link href="{{ asset('/plugins/datepicker/datepicker3.css') }}" rel="stylesheet" type="text/css" />
@append
    {{--head--}}

        <div class="col-xs-6">
            <div class="panel panel-success">
                <div class="panel-heading">Factura</div>
                <div class="panel-body">
                                             <div class="row">
                                                 <div class="col-xs-12">
                                                                <div class="control-group">


                                                                  <div class="controls">
                                                                   @if(isset($model))
                                                                     {!! Form::hidden('client_list', $model->client_id) !!}
                                                                   @endif
                                                                   {!! Form:: label ('client_list','Elija un Cliente:')!!}
                                                                   {!! Form:: select ('client_list',$clients,null,['class'=>'form-control input-lg','id'=>'clients'])!!}
                                                                   {!! Form::hidden('visit_id', $visit) !!}

                                                                    <p class="help-block">Al cual se realizara la venta</p>
                                                                  </div>
                                                                </div>
                                                                <div class="control-group">
                                                                <div id="providerInfo"></div>
                                                                </div>


                                                                </div>
                                             </div>
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
                                         <div class="callout callout-sutil">
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
                                                    <label for="cant">Cantidad</label>
                                                    <div class="input-group spinner"><input id="cant"  name="cant" type="text" class="form-control" value="1"><div class="input-group-btn-vertical"><button class="btn btn-default" type="button"><i class="fa fa-caret-up"></i></button><button class="btn btn-default" type="button"><i class="fa fa-caret-down"></i></button></div></div>

                                                    </div>
                                                     </div>
                                                <div class="col-xs-2">
                                                <div class="form-group">
                                                    <label for="price">Impuesto</label>
                                                    <div>
                                                    <p id="tax" class="label label-success">0%</p>
                                                    </div>

                                                </div>
                                                </div>

                                                <div class="col-xs-2">
                                                <div class="form-group">
                                                    <label for="price">Precio</label>

                                                    <input name="price" class="form-control" id="price" type="text"/>
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
                                            <th class="col-lg-2"style=" text-align: right" >Cant</th>
                                            <th class="col-md-1" style="width:120px; text-align: right">Precio</th>
                                            <th class="col-md-1" style="text-align: right">Impuesto</th>
                                            <th class="col-md-2" style=" text-align: right">Total</th>
                                            <th class="col-md-2"></th>
                                            </tr>
                                           </thead>

                                           <tbody id="detail">
                                           @if(isset($model))
                                             @foreach($model->details as $detail)
                                            <tr>
                                            <td>{{$detail->product_id}}</td>
                                            <td>{{$detail->product->description}}</td>
                                            <td style="text-align: right">{{$detail->cant}}</td>
                                            <td style="text-align: right">{{number_format($detail->price,0,'','.')}}</td>
                                            <td style="text-align: right"><span class="label label-success">{{$detail->product->tax->valor}} %</span></td>
                                            <td style="text-align: right"><p class="exc-title-primary">{{number_format($detail->price*$detail->cant,0,'','.')}}</p></td>
                                            <td><a  style="padding-right: 10px" class="btn btn-success btn-sm btnEdit btnEdit"><i class="fa fa-pencil"></i></a>
                                            <a  class=" btnDelete btn btn-danger btn-sm"><i class="fa fa-trash-o"></i></a> </td></tr>

                                             @endforeach
                                           @endif
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
       <div class="panel panel-success">
         <div class="panel-heading">Subtotales
                                                                         </div>
         <div class="panel-body" id="subtotals">
                                                                            <table class="table table-striped table-condensed">
                                                                            <thead>
                                                                            <tr>
                                                                            <th class="col-md-4" style=" width:60px text-align: left"><p><b>Excentos: </b></p></th>
                                                                            <th class="col-md-4" style=" width:60px text-align: left"><p><b>Iva 5: </b></th>
                                                                            <th class="col-md-4" style=" width:60px text-align: left"><p><b>Iva 10: </b></th>
                                                                            <th style="text-align: right"></th>
                                                                            </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                            <tr>
                                                                            <td><p id="excentos">Gs 0 </p></td>
                                                                            <td><p id="iva5" >Gs. 0 </p></td>
                                                                            <td><p id="iva10">Gs. 0 </p></td>
                                                                            </tr>

                                                                            <tr>
                                                                            <td class="col-md-4"><h4><b>Total </b></h4></td>
                                                                            <td colspan="2" class="col-md-6"><h4 id="total">Gs. 0 </h4></td>

                                                                            </tr>



                                                                            </tbody>
                                                                            </table>

                                                                           </div>
       </div>
        {!!Form:: submit('Guardar',['class'=>'btn btn-success','id'=>'submit'])!!}
    </div>
 </div><!-- /.row -->

    <div id="inputZone"></div>

@section('javascripts')
<script src="{{ URL::asset('/js/select2.full.min.js') }}"></script>
<script type="text/javascript">
{{--init variables--}}
$("#clients").select2();
$("#products").select2();
$(".btnAdd").bind("click", add);
$(".btnDelete").bind("click", remove);
$(".btnEdit").bind("click", edit);

makFormula();
$("#clients").change(function(){

blank();
makeProviders();
});


$("#products").change(function(){
makeProducts();
 });

@if(isset($model))
/*ON DOC BEGIN*/
$( document ).ready(function() {
makeProviders();
});
@endif

/*********************************************************************************************/
function makeProviders(){

if($("#clients").val()!='0'){
spin('providerInfo'); spin('spinner');
     makeSpinner();
      disable(true);
     var token= '{{csrf_token()}}';
     var data={_token:token, id:$("#clients").val()};

    $.ajax({
                url: '{{ action("StockControllers\ReturnNoteController@getClient") }}',
                type: 'POST',
                data:data
                })
                .done (function (data2){
                $("#spinner").html("");
                   //recorremos todas las filas del resultado del proceso que obtenemos en Json
                   $("#products").append("<option value=0>Seleccionar un Producto</option>");
                   $('#providerInfo').html('<div class="animsition fade-in"><div class="col-xs-6">' +
                    '<p><b>Razon Social: </b> '+data2.razon  +'</p>' +
                    '<p><b>RUC:</b> '+data2.ruc  +'</p>' +
                    '<p><b>Empresa:</b> '+data2.description  +'</p>' +
                    '</div>' +
                    '<div class="col-xs-6"></div>' +
                    '<p><b>Telefono: </b>'+data2.tel  +'</p>' +
                     '<p><b>Direccion: </b>'+data2.direcc  +'</p>' +

                       '</div>');
                   disable(false);
                  });
                   }
    }
/*********************************************************************************************/
function makeProducts(){
if($("#products").val()!=0){
    spin('spinner');
    $('#products').prop("disabled", true);
    disable(true);

     var token= '{{csrf_token()}}';
     var data={_token:token, id:$('#products').val()};

     $.ajax({
            url: '{{ action("StockControllers\PurchaseController@getProductPrice") }}',
            type: 'POST',
            data:data
            }).done (function (data2){
            disable(false);
            $("#spinner").html("");
            $('#price').val(data2[0]);
            $('#cant').val(1);
            $('#tax').html(data2[1]+'% '+ data2[2]);
            $('#products').prop("disabled", false);
              });
 }
}


/************************************inteface functions******************************/
function spin(id){
 $('#'+id).html('<div style="text-align: center"><i class="fa fa-spinner fa-pulse fx-5-" style="color: slategray"></div>');
}

function blank(){
$('#price').val('');
$('#cant').val('');
makeSubtotals(0,0,0);
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
     '<td style="text-align: right">'+number_format($("#price").val(),0,'','.')+'</td>' +
     '<td style="text-align: right"><span class="label label-success">'+$('#tax').text()+'</span></td>' +
     '<td style="text-align: right"><p class="exc-title-primary">'+number_format(Number($("#price").val())*Number($("#cant").val()),0,'','.')+' </p></td>'+
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
 makFormula();
}

function remove(){
$(this).parent().parent().remove(); //tr
disable(false);
 makFormula();
}

function edit(){
disable(true);
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
        $('.btnEdit').prop("disabled", false);
        $('.btnDelete').prop("disabled", false);
        console.log($tr);
        price=Number($tr.find("td").eq(3).html().replace(/[.]/g,''))*newNumber;
        $tr.find("td").eq(5).find("p").html(number_format(price,0,'','.'));
        disable(false);
        makFormula();
    }

}

/********************************formula functions*******************************/

function makeSubtotals(excentos,iva5,iva10){
    var total=Number(excentos)+ Number(iva5) + Number(iva10);
    $('#excentos').text(number_format(excentos,0,'','.'));
    $('#iva5').text(number_format(iva5,0,'','.'));
    $('#iva10').text(number_format(iva10,0,'','.'));
    $('#total').text(number_format(total,0,'','.'));
}

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

function makFormula(){
    var p=true; var excent=0;  var iva5=0;  var iva10=0;
    $('#detail > tr').each(function() {
      var tax=$(this).find("td").eq(4).find("span").html().substr(0,2);
      var number=Number($(this).find("td").eq(5).find("p").html().replace(/[.]/g,''));

      switch(tax){
        case '0%':
        excent=excent+number;
        break;

        case '5%':
        iva5=iva5+number;
        break;

        case '10':
        iva10=iva10+number;
        break;
      }
        number=0;
    });
makeSubtotals(excent,iva5,iva10);
}


/**********************************************inputs submits****************************************/
function getInputs(){
    $('#inputZone').html("");
    $postvalue = "";
    var cant=0;
    var price=0;
    var id=0;
    var array=[];
    $('#detail > tr').each(function() {
        id=Number($(this).find("td").eq(0).html().replace(/[.]/g,''));
        cant=Number($(this).find("td").eq(2).html().replace(/[.]/g,''));
        price=Number($(this).find("td").eq(3).html().replace(/[.]/g,''));
        array=[id,cant,price];
      $('#inputZone').append('<input type="hidden" name="result[]" value="' +array+ '" />');
    });
    $('#inputZone').append('<input type="hidden" name="iva_10" value="' +$('#iva10').text().replace(/[.]/g,'')+ '" />');
    $('#inputZone').append('<input type="hidden" name="iva_5" value="' +$('#iva5').text().replace(/[.]/g,'')+'" />');
    $('#inputZone').append('<input type="hidden" name="excento" value="'+$('#excentos').text().replace(/[.]/g,'')+ '" />');
    $('#inputZone').append('<input type="hidden" name="total" value="'+$('#total').text().replace(/[.]/g,'')+ '" />');
    $('#inputZone').append('<input type="hidden" name="comments" value="'+$('#msj').val()+ '" />');
}

$( "#submit" ).click(function() {
  getInputs();
  $( "#form" ).submit();
});


 </script>
@append