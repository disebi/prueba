@extends('app2')


@include('partials.bread._create')
@include('purchase.help_create')
@section('css')
<link href="/css/gsdk-base.css" rel="stylesheet" />
@append
@section('content')
<div class="col-sm-12">
            <!--      Wizard container        -->
            <div class="wizard-container">
                <div class="card wizard-card ct-wizard-orange" id="wizardProfile">
                    <form action="">
                <!--        You can switch "ct-wizard-orange"  with one of the next bright colors: "ct-wizard-blue", "ct-wizard-green", "ct-wizard-orange", "ct-wizard-red"             -->
                    	<div class="wizard-header">
                        	<h3>
                        	   <b>CREA</b> NUEVA VISITA <br>
                        	   <small>Visita realizada a zona.</small>
                        	</h3>
                    	</div>
                    	<ul>
                            <li><a href="#about" data-toggle="tab">Visita</a></li>
                            <li><a href="#account" data-toggle="tab">Pedidos</a></li>
                            <li><a href="#address" data-toggle="tab">Envio</a></li>
                        </ul>
                        <div class="tab-content" id="app">
                            <div class="tab-pane" id="about">
                              <div class="row">
                                  <h4 class="info-text"> Estas a punto de crear una visita</h4>

                                  <div class="col-sm-12">
                                        <div class="control-group">
                                           <p class="help-block">Zona que se visitara @{{ salesman }} @{{zone_id}}</p>
                                           <div class="controls">
                                                 {!! Form:: select ('zone_list',$zones,null,['v-model'=>'zone_id','class'=>'form-control input-lg','required'])!!}

                                                <small><b>Vendedor: </b>@{{ salesman }}</small><br/>
                                                <small><b>Ciudad: </b>@{{ city_name }}</small><br/>
                                                 <div id="inputZone"></div>
                                           </div>
                                       </div>

                                       <div class="control-group">
                                             <p class="help-block">Fecha probable de reparto</p>
                                             <div class="controls">
                                                   <div class="input-group date">
                                                   {!! Form:: text ('delivery_date',null,['v-model'=>'delivery_date','class'=>'form-control','required','date'])!!}
                                                     <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                                                   </div>
                                              </div>
                                       </div>
                                  </div>
                              </div>
                            </div>
                            <div class="tab-pane" id="account">
                                <h4 class="info-text">Elije un cliente y los productos que desea  </h4>
                                    <div class="col-sm-10 col-sm-offset-1">
                                        <div class="col-xs-12">
                                        <div class="panel panel-success">
                                            <div class="panel-heading">Cliente</div>
                                             <div class="panel-body">
                                            <div class="control-group">
                                              {!! Form:: label ('client_list','Elija un Cliente:')!!}
                                              {!! Form:: select ('client_list',[0=>'Seleccione un cliente'],null,['v-model'=>'order.client_id','class'=>'form-control input-lg','id'=>'clients'])!!}
                                            </div>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12">
                                       <div class="panel panel-success">
                                            <div class="panel-heading">Detalle</div>
                                            <div class="panel-body">
                                               <div class="callout callout-sutil">
                                                   <h4>Seleccionar Producto</h4>
                                                  <div class="row">

                                                                                    <div class="col-xs-12">
                                                                                        <div class="col-xs-8">
                                                                                          <div class="form-group">
                                                                                            <label for="products">Producto</label>

                                                                                            {!! Form:: select ("products",$products,null,["class"=>"form-control","id"=>"products"])!!}
                                                                                             </div>
                                                                                        </div>
                                                                                        <div class="col-xs-4">
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
                                                                                        <div class="col-xs-3">
                                                                                        <div class="form-group">
                                                                                            <label for="price">Precio</label>

                                                                                            <input name="price" class="form-control" id="price" type="text"/>
                                                                                        </div>
                                                                                        </div>

                                                                                        <div class="col-xs-2">
                                                                                        <div class="form-group">
                                                                                        <label for="plus"> Agregar</label>
                                                                                        <div>
                                                                                        <a id="plus"  class="btnAdd btn btn-fill btn-success btn-sm"><i class="fa fa-plus"></i></a>

                                                                                        </div>    </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    </div>
                                               </div>
                                                   <table  class="table table-striped">
                                                     <thead>
                                                        <tr>
                                                         <th  class="col-md-1"  >#</th>
                                                         <th class="col-md-3" >Producto</th>
                                                         <th class="col-lg-2" style=" text-align: right" >Cant</th>
                                                         <th class="col-md-1" style="width:120px; text-align: right">Precio</th>
                                                         <th class="col-md-1" style="text-align: right">Impuesto</th>
                                                         <th class="col-md-2" style=" text-align: right">Total</th>
                                                         <th class="col-md-2"></th>
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

                                    <div class="col-xs-12">
                                          <div class="panel panel-success">
                                             <div class="panel-heading">Subtotales </div>
                                                <div class="panel-body" id="subtotals">
                                                 <table class="table table-striped table-condensed">
                                                     <thead>
                                                       <tr>
                                                        <th class="col-md-4" style=" width:60px text-align: left"><p><b>Excentos: </b></p></th>
                                                        <th class="col-md-4"  style=" width:60px text-align: left"><p><b>Iva 5: </b></th>
                                                        <th class="col-md-4"  style=" width:60px text-align: left"><p><b>Iva 10: </b></th>
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
                                    </div>
                                    <div class="col-xs-12">
                                       <div class="panel panel-default">
                                                         <div class="panel-heading">Informacion</div>
                                                         <div class="panel-body">
                                                            <div class="form-group">
                                                              <label for="coment">Observaciones</label>
                                                                    {!!Form::textarea('coment',null,[ 'class'=>'form-control', 'id'=>'coment', 'style'=>'resize: none','rows'=>'5']) !!}
                                                                      <div class="controls">
                                                                        <p>Notas acerca de la factura</p>
                                                                      </div>
                                                            </div>
                                                         </div>
                                                    </div>
                                    </div>

                                    <div class="control-group" style="text-align: center">
                                    <input type='button' @click=addOrder(); class='btn  btn-fill btn-success btn-wd btn-sm' name='sendOrder' value='Encolar Pedido' />
                              </div>
                              </div>
                            <div class="tab-pane" id="address">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <h4 class="info-text"> Desea enviar su visita a @{{ zone_name }}?</h4>
                                    </div>
                                    <div class="col-sm-12">

                                           <div class="inv" v-for="invoice in sending">
                                           <div class="col-sm-12">
                                           <div class="col-sm-4">
                                            <h4>Orden</h4>
                                           <p><b>Cliente</b>: @{{ invoice.client_name }} </p>
                                           <p><b>Total</b>: @{{ invoice.total }} </p>

                                           </div>
                                           <div class="col-sm-8" >
                                           <table class="table table-condensed table-striped">
                                           <thead>
                                           <tr>
                                                                                      <th>Id</th>
                                                                                      <th>Producto</th>
                                                                                      <th>Cant</th>
                                                                                      <th>Precio</th>
                                                                                      </tr>
                                           </thead>
                                           <tbody v-for="product in invoice.products">
                                           <tr>
                                              <td> @{{ product[0] }} </td>
                                              <td> @{{ product[3] }} </td>
                                               <td> @{{ product[1] }} </td>
                                              <td> @{{ product[2] }} </td>
                                           </tr>
                                           </tbody>
                                           </table>



                                           </div>
                                           </div>
                                           </div>


                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="wizard-footer">
                            <div class="pull-right">
                                <input type='button' class='btn btn-next btn-fill btn-warning btn-wd btn-sm' name='next' value='Siguiente' />
                                <input type='button' id="submit" class='btn btn-finish btn-fill btn-warning btn-wd btn-sm' name='finish' value='Terminar' />
                            </div>

                            <div class="pull-left">
                                <input type='button' class='btn btn-previous btn-fill btn-default btn-wd btn-sm' name='previous' value='Anterior' />
                            </div>
                            <div class="clearfix"></div>
                        </div>


                   </form>
                </div>
            </div> <!-- wizard container -->
            </div>



<div id="loading" class="modal modal-primary fade" role="dialog" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        {{--<button type="button" class="close" data-dismiss="modal">&times;</button>--}}
        <h4 class="modal-title">Enviando Visitas</h4>
      </div>
      <div class="modal-body">
        <p>Enviando Visita: <code></code></p>
       <div class="progress progress-sm active ">
                       <div class="progress-bar progress-bar-warning progress-bar-striped" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                         <span class="sr-only">Enviando</span>
                       </div>
                     </div>
      </div>
      <div class="modal-footer">
        {{--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>--}}
      </div>
    </div>

  </div>
</div>


@endsection
@include('partials._date')
@include('...partials._functionMsj')

@section('javascripts')
<!--   plugins 	 -->

	<script src="/js/jquery.bootstrap.wizard.js" type="text/javascript"></script>
    <!--  More information about jquery.validate here: http://jqueryvalidation.org/	 -->
	<script src="/js/jquery.validate.min.js"></script>
    <!--  methods for manipulating the wizard and the validation -->
	<script src="/js/wizard.js"></script>
<script src="/js/vue.js" type="text/javascript"></script>
	<script>
    $('.input-group.date').datepicker({
                startView: 2,
                language: "es",
                format: "yyyy-mm-dd"
            });
/********************** vuestuff ************************************/

           var AjaxInfo=null;
    var vueStaff=    new Vue({
        el:'#app',
        data:{
            zone_name:'',
            salesman:'',

            zone_id:'',
            delivery_date:'',
            city_name:'',
            order:{
                    products:[],
                    iva_10:'',
                    iva_5:'',
                    excento:'',
                    total:'',
                    coment:'',
                    client_id:'',
                    client_name:''
            },
            sending:[]
            },
        watch: {
            zone_id: function(value) {
            this.callZone();
            }
        },
        methods:{
            callZone:function(){
            ajaxFun();
            },
            getInputs: function (){
                    var cant=0;
                    var price=0;
                    var id=0;
                    var product='';
                    var array=[];
                    $('#detail > tr').each(function() {
                        id=Number($(this).find("td").eq(0).html().replace(/[.]/g,''));
                        product=$(this).find("td").eq(1).html();
                        cant=Number($(this).find("td").eq(2).html().replace(/[.]/g,''));
                        price=Number($(this).find("td").eq(3).html().replace(/[.]/g,''));
                        array.push([id,cant,price,product]);
                    });
                    this.order.products=array;
                    this.order.coment=$('#coment').val();;
                    this.order.iva_10 = $('#iva10').text().replace(/[.]/g,'');
                    this.order.iva_5 = $('#iva5').text().replace(/[.]/g,'');
                    this.order.excento = $('#excento').text().replace(/[.]/g,'');
                    this.order.total = $('#total').text().replace(/[.]/g,'');
                    this.order.client_id = $('#clients').val();
                    this.sending.push({
                                                          products: this.order.products,
                                                          iva_10: this.order.iva_10,
                                                          iva_5: this.order.iva_5,
                                                          excento: this.order.excento,
                                                          total: this.order.total,
                                                          coment: this.order.coment,
                                                          client_id: this.order.client_id,
                                                          client_name: $('#clients :selected').text()
                                                  });

                },
            addOrder: function(){
               this.getInputs();
               this.cleanAll();
               mensajito('success','El pedido se ha encolado');
            },
            cleanOrder: function(){
                $('#iva10').text(0);
                $('#iva5').text(0);
                $('#excentos').text(0);
                $('#total').text(0);
            },
            cleanAll: function(){
            $('#detail').html('');
                this.cleanOrder();
            }
        }
        });

$(".btnAdd").bind("click", add);
$(".btnDelete").bind("click", remove);
$(".btnEdit").bind("click", edit);
$("#products").change(function(){
makeProducts();
 });
function ajaxFun(){
 $.post('{{ action("DistributionControllers\VisitController@getZone") }}', {_token:'{{csrf_token()}}', 'zone':vueStaff.$data.zone_id}, function (data2){
                vueStaff.$data.zone_name = data2[0].description;
                vueStaff.$data.salesman = data2[0].salesman;
                vueStaff.$data.city_name = data2[0].city;
                $.each(data2[1], function(i,item){
                $("#clients").append("<option value="+item.id+">"+item.description+"</option>");
                 });
});
}

function makeProducts(){
if($("#products").val()!=0){

    $('#products').prop("disabled", true);

     var token= '{{csrf_token()}}';
     var data={_token:token, id:$('#products').val()};

     $.ajax({
            url: '{{ action("StockControllers\PurchaseController@getProductPrice") }}',
            type: 'POST',
            data:data
            }).done (function (data2){

            $("#spinner").html("");
            $('#price').val(data2[0]);
            $('#cant').val(1);
            $('#tax').html(data2[1]+'% '+ data2[2]);
            $('#products').prop("disabled", false);
              });
 }
}


function add(){
if(!($('#cant').val()=='0') && !($('#products').val()=='0') && !($('#price').val()=='0')){

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

 makFormula();
}

function edit(){
var $tr= $(this).parent().parent();
    $.when( { number:$(this).parent().parent().find("td").eq(2).html() } ).done(function(x ) {
         $tr.find("td").eq(2).html('<div class="input-group">' +
      '<div class="input-group-btn">' +
       '<a type="a" class="btn btn-default reEdit">' +
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

        price=Number($tr.find("td").eq(3).html().replace(/[.]/g,''))*newNumber;
        $tr.find("td").eq(5).find("p").html(number_format(price,0,'','.'));

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

$( "#submit" ).click(function() {
var string= JSON.stringify(vueStaff.$data);
$('#loading').show();
$.post('{{ action("DistributionControllers\VisitController@store") }}', {_token:'{{csrf_token()}}', 'zone':vueStaff.$data}, function (data2){
                if(data2.state==true){
                $('#loading').modal();
                  mensajito('success','Su visita se ha guardado exitosamento');
                   window.location.href = "/visitas/"+data2.id;
               } else{
                $('#loading').modal('hide');
                    mensajito('error','existen problemas con la carga de sus pedidos, favor comunicarse con soporte')
                }

});

});
/**********************************************inputs submits****************************************/
	</script>
@append
