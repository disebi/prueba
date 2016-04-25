@extends('app2')


@section('content')
  <section class="content-header">
  <h2>Dashboard</h2>
  </section>
  <section class="content">
  <div class="row">
  <div class="col-md-9">
    <div class="panel panel-success">
    				<div class="panel-heading">Informacion Semanal</div>
    				<div class="panel-body">
                    <div id="chartdiv" style="width : 100%; height : 250px;font-size	: 11px;"></div>
    				</div>
    			</div>


           <div class="col-lg-3 col-xs-6">
             <!-- small box -->
             <div class="small-box bg-aqua">
               <div class="inner">
                 <h3>{{$order_count}}</h3>

                 <p>Ordenes en el Mes</p>
               </div>
               <div class="icon">
                 <i class="ion ion-bag"></i>
               </div>
               <a href="/ordenes" class="small-box-footer">Mas <i class="fa fa-arrow-circle-right"></i></a>
             </div>
           </div>
           <!-- ./col -->
           <div class="col-lg-3 col-xs-6">
             <!-- small box -->
             <div class="small-box bg-green">
               <div class="inner">
                 <h3>{{$visit_count}} </h3>

                 <p>Visitas del Mes</p>
               </div>
               <div class="icon">
                 <i class="ion ion-stats-bars"></i>
               </div>
               <a href="/visitas" class="small-box-footer">Mas <i class="fa fa-arrow-circle-right"></i></a>
             </div>
           </div>
           <!-- ./col -->
           <div class="col-lg-3 col-xs-6">
             <!-- small box -->
             <div class="small-box bg-yellow">
               <div class="inner">
                 <h3>44</h3>

                 <p>User Registrations</p>
               </div>
               <div class="icon">
                 <i class="ion ion-person-add"></i>
               </div>
               <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
             </div>
           </div>
           <!-- ./col -->
           <div class="col-lg-3 col-xs-6">
             <!-- small box -->

           </div>

           <div class="col-lg-3 col-xs-6">
                                 <!-- small box -->
                                 <div class="small-box bg-red">
                                   <div class="inner">
                                     <h3>65</h3>

                                     <p>Unique Visitors</p>
                                   </div>
                                   <div class="icon">
                                     <i class="ion ion-pie-graph"></i>
                                   </div>
                                   <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                                 </div>
                               </div>

            <div class="col-md-12">
            <div class="box box-info">
                                                       <div class="box-header with-border">
                                                         <h3 class="box-title">Ordenes de Trabajo para Hoy</h3>

                                                         <div class="box-tools pull-right">
                                                           <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                                           </button>
                                                           <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                                         </div>
                                                       </div>
                                                       <!-- /.box-header -->
                                                       <div class="box-body">
                                                         <div class="table-responsive">
                                                           <table class="table no-margin">
                                                             <thead>
                                                             <tr>
                                                               <th>Order ID</th>
                                                               <th>Item</th>
                                                               <th>Status</th>
                                                               <th>Camion</th>
                                                             </tr>
                                                             </thead>
                                                             <tbody>
                                                             <tr>
                                                               <td><a href="pages/examples/invoice.html">OR9842</a></td>
                                                               <td>Call of Duty IV</td>
                                                               <td><span class="label label-success">Shipped</span></td>
                                                              <td> - </td>
                                                             </tr>
                                                             <tr>
                                                               <td><a href="pages/examples/invoice.html">OR1848</a></td>
                                                               <td>Samsung Smart TV</td>
                                                               <td><span class="label label-warning">Pending</span></td>
                                                               <td> - </td>
                                                             </tr>
                                                             <tr>
                                                               <td><a href="pages/examples/invoice.html">OR7429</a></td>
                                                               <td>iPhone 6 Plus</td>
                                                               <td><span class="label label-danger">Delivered</span></td>
                                                               <td> - </td>
                                                             </tr>
                                                             <tr>
                                                               <td><a href="pages/examples/invoice.html">OR7429</a></td>
                                                               <td>Samsung Smart TV</td>
                                                               <td><span class="label label-info">Processing</span></td>
                                                               <td> - </td>
                                                             </tr>
                                                             <tr>
                                                               <td><a href="pages/examples/invoice.html">OR1848</a></td>
                                                               <td>Samsung Smart TV</td>
                                                               <td><span class="label label-warning">Pending</span></td>
                                                               <td> - </td>
                                                             </tr>
                                                             <tr>
                                                               <td><a href="pages/examples/invoice.html">OR7429</a></td>
                                                               <td>iPhone 6 Plus</td>
                                                               <td><span class="label label-danger">Delivered</span></td>
                                                              <td> - </td>
                                                             </tr>
                                                             <tr>
                                                               <td><a href="pages/examples/invoice.html">OR9842</a></td>
                                                               <td>Call of Duty IV</td>
                                                               <td><span class="label label-success">Shipped</span></td>
                                                              <td> - </td>
                                                             </tr>
                                                             </tbody>
                                                           </table>
                                                         </div>
                                                         <!-- /.table-responsive -->
                                                       </div>
                                                       <!-- /.box-body -->
                                                      <div class="box-footer clearfix">
                                                                    <a href="javascript::;" class="btn btn-sm btn-info btn-flat pull-left">Place New Order</a>
                                                                    <a href="javascript::;" class="btn btn-sm btn-default btn-flat pull-right">View All Orders</a>
                                                                  </div>
                                                                  <!-- /.box-footer -->
                                                                </div>
            </div>
           <!-- ./col -->

  </div>
  <div class="col-md-3">
  <div class="col-md-12">
    <div class="panel panel-warning">
      				<div class="panel-heading">Mejores Vendedores</div>
      				<div class="panel-body">
                         <h3>Top Vendedores</h3>
                          <p>A continuacion se muestra los mejores vendedores del mes:</p>
                          <table class="table table-condensed table-hover">
                            <thead>
                              <tr>
                                <th>Nombre</th>
                                <th>Venta de Hoy</th>
                              </tr>
                            </thead>
                            <tbody>
                            @for($x=0; $x<10; $x++)
                              <tr>
                                <td>John</td>
                                <td>Doe</td>

                              </tr>
                            @endfor
                            </tbody>
                          </table>
      				</div>
      			</div>
  </div>
      			<div class="col-md-12">
      			<div class="panel panel-success">
                            <div class="panel-heading ">
                              Compras hechas


                            </div>
                            <!-- /.box-header -->
                            <div style="display: block;" class="panel-body">
                              <ul class="products-list ">
                              @foreach($buys as $buy)
                                <li class="item">
                                  <div class="">
                                    <a href="/compras/{{$buy->id}}" class="product-title">{{$buy->provider->description}}
                                      <span class="label label-warning pull-right">{{number_format($buy->total,0,',','.')}} Gs.</span></a>
                                        <span class="product-description">
                                         {{$buy->products()->sum('cant')}} Productos Adquiridos
                                         </span>
                                  </div>
                                </li>

                                @endforeach

                                <!-- /.item -->
                              </ul>
                            </div>
                            <!-- /.box-body -->
                            <div style="display: block;" class="box-footer text-center">
                              <a href="/compras" class="uppercase">Ver Todas las Compras</a>
                            </div>
                            <!-- /.box-footer -->
                          </div>
      			</div>

  </div>
  </div>

  </section>

@stop

@section('javascripts')
<script src="/js/amcharts/amcharts.js"></script>
<script src="/js/amcharts/serial.js"></script>
<script src="/js/amcharts/themes/light.js"></script>
<script type="text/javascript">

$( document ).ready(function() {

 barGeneralView ('chartdiv',[[1000000,500000,600000,900000,1700000,1600000,1000000],[2000000,2000000,2000000,2000000,2000000,2000000,2000000],[3000000,3000000,3000000,3000000,3000000,3000000,3000000]],['#669900','#ff3399','#ffcc00'],'titulo',7);
});
function showDay(days){
    var d = new Date();
    d.setDate(d.getDate() - days);
    return ["Dom","Lun","Mar","Mierc","Juev","Vier","Sab"][d.getUTCDay()];
}
function barGeneralView (div,sales,color,title,days,month){
    var data= [];
    var hoydate = new Date();
    var hoy= hoydate.getDate();

    if(month==null){
        for (var x= 0;x<days;x++){

            if(x==(days-1)){
                if (sales[1][x] == 1) {
                    data.push ({
                        "dia": 'Hoy',
                        "monto": (sales[0][x]/1000000).toFixed(2),
                        "alpha": 0.2,
                        "dashLengthColumn": 5
                    })

                } else {
                    data.push ( {
                        "dia": 'Hoy',
                        "monto": (sales[0][x]/1000000).toFixed(2),
                        "objetivo": (sales[1][x]/1000000).toFixed(2),
                        "dashLengthColumn": 5,
                        "alpha": 0.2
                    })
                }
            }else {
                if (sales[1][x] == 1) {
                    data.push ( {
                        "dia": showDay(6 - x),
                        "monto": (sales[0][x] / 1000000).toFixed(2)
                    })

                } else {
                    data.push ({
                        "dia": showDay(6 - x),
                        "monto": (sales[0][x] / 1000000).toFixed(2),
                        "objetivo": (sales[1][x] / 1000000).toFixed(2)
                    })
                }
            }
            if(sales[2][x]!=1){
                data[x]["tendencia"]=(sales[2][x]/1000000).toFixed(2)
            }
        }
    }else{
        for (var x= 0;x<days;x++){

            if(x==(hoy-1)){
                if (sales[1][x] == 1) {
                    data.push ({
                        "dia": 'Hoy',
                        "monto": Math.round(sales[0][x]/1000000),
                        "alpha": 0.2,
                        "dashLengthColumn": 5
                    })

                } else {
                    data.push ( {
                        "dia": 'Hoy',
                        "monto": Math.round(sales[0][x]/1000000),
                        "objetivo": Math.round(sales[1][x]/1000000),
                        "dashLengthColumn": 5,
                        "alpha": 0.2
                    })
                }
            }else {
                if (sales[1][x] == 1) {
                    data.push ( {
                        "dia": x+1,
                        "monto": Math.round(sales[0][x] / 1000000)

                    })

                } else {
                    data.push ({
                        "dia":x+1,
                        "monto": Math.round(sales[0][x] / 1000000),
                        "objetivo": Math.round(sales[1][x] / 1000000)
                    })
                }
            }
            if(sales[2][x]!=1){
                data[x]["tendencia"]=Math.round(sales[2][x]/1000000)
            }
        }
    }


    AmCharts.makeChart(div, {
        "type"         : "serial",
        "theme"        :  "light",
//        "fontFamily"   :   "Lato",
        "startDuration":        0,
        "autoMargins"  :    true,

        "marginLeft"   :       30,
        "marginRight"  :        8,
        "marginTop"    :       10,
        "marginBottom" :       26,

        'numberFormatter': {decimalSeparator: ",", thousandsSeparator: "."},
        'chartCursor': {cursorPosition: "mouse", categoryBalloonDateFormat: "MMM DD, YYYY"},
        "colors"       :  color,
        "titles"       :  [
            {
                "text" : title,
                "size" : 15
            }
        ],
        "balloon": {
            "adjustBorderColor" : false,
            "horizontalPadding" : 10,
            "verticalPadding"   : 8,
            "color"             : "#ffffff"
        },
        "dataProvider": data,
        "valueAxes": [{
            "axisAlpha": 0,
            "position": "left"
        }],
        "chartScrollbar": {
            "scrollbarHeight":15,
            "offset":-1,
            "backgroundAlpha":0.1,
            "backgroundColor":"#E6E6E6",
            "selectedBackgroundColor":"#999999",
            "selectedBackgroundAlpha":1
        },
        "graphs": [{
            "alphaField": "alpha",
            "balloonText": "<span style='font-size:12px;'>[[title]] en [[category]]:<br><span style='font-size:20px;'>[[value]]</span> [[additional]]</span>",
            "fillAlphas": 1,
            "title": "Monto",
            "type": "column",
            "valueField": "monto",
            "dashLengthField": "dashLengthColumn"
        }, {
            "id": "graph2",
            "balloonText": "<span style='font-size:12px;'>[[title]] en [[category]]:<br><span style='font-size:20px;'>[[value]]</span> [[additional]]</span>",
            "bullet": "round",
            "lineThickness": 3,
            "bulletSize": 7,
            "bulletBorderAlpha": 1,
            "bulletColor": "#FFFFFF",
            "useLineColorForBulletBorder": true,
            "bulletBorderThickness": 3,
            "fillAlphas": 0,
            "lineAlpha": 1,
            "title": "Objetivo",
            "valueField": "objetivo"
        },{
            "id": "graph3",
            "balloonText": "<span style='font-size:12px;'>[[title]] in [[category]]:<br><span style='font-size:20px;'>[[value]]</span> [[additional]]</span>",
            "bullet": "round",
            "lineThickness": 3,
            "bulletSize": 7,
            "bulletBorderAlpha": 1,
            "bulletColor": "#FFFFFF",
            "useLineColorForBulletBorder": true,
            "bulletBorderThickness": 3,
            "fillAlphas": 0,
            "lineAlpha": 1,
            "title": "Tendencia",
            "valueField": "tendencia"
            }],
        "categoryField": "dia",
        "categoryAxis": {
            "position":"top",
            "gridPosition": "start",
            "axisAlpha": 0,
            "tickLength": 0
        },
        "export": {
            "enabled": true,
            "position": "top-left"

        }
    });

}


</script>
@stop

