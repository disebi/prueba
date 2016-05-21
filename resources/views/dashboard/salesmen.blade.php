@extends('app2')

@section('bread')
          <h1>
            Dashboard
            <small>{{$staff->name.' '.$staff->last_name}} </small>
           </h1>

@endsection
@section('content')


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
                                     <h3>{{number_format($sale_count,0,'.','.')}}</h3>

                                     <p>Ventas</p>
                                   </div>
                                   <div class="icon">
                                     <i class="ion ion-person-add"></i>
                                   </div>
                                   <a href="/ventas" class="small-box-footer">Ver mas<i class="fa fa-arrow-circle-right"></i></a>
                                 </div>
                               </div>
                    <!-- ./col -->


                    <div class="col-lg-3 col-xs-6">
                                          <!-- small box -->
                                          <div class="small-box bg-red">
                                            <div class="inner">
                                              <h3>{{number_format($total,0,'.','.')}}</h3>

                                              <p>Comision del Mes</p>
                                            </div>
                                            <div class="icon">
                                              <i class="ion ion-pie-graph"></i>
                                            </div>
                                            <a href="/visitas/create" class="small-box-footer">Realizar Visitas <i class="fa fa-arrow-circle-right"></i></a>
                                          </div>
                                        </div>

           <!-- ./col -->


@stop

@section('javascripts')
<script src="/js/amcharts/amcharts.js"></script>
<script src="/js/amcharts/serial.js"></script>
<script src="/js/amcharts/themes/light.js"></script>
<script type="text/javascript">

$( document ).ready(function() {

 barGeneralView ('chartdiv',{!!json_encode($month)!!}, {{$obj}} ,

                             ['#669900','#ff3399','#ffcc00'],'Mes');
});


function showDay(days){
    var d = new Date();
    d.setDate(d.getDate() - days);
    return ["Dom","Lun","Mar","Mierc","Juev","Vier","Sab"][d.getUTCDay()];
}
function barGeneralView (div,sales,obj,color,title){
    var data= [];
    var obj_lin=(Number(obj)/30).toFixed(2);

        for (var x= 0;x<sales.length; x++){
                    data.push ({
                        "dia": x+1,
                        "monto": sales[x],
                       "objetivo": obj_lin
                    })
        }
console.log(data);

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
            "balloonText": "<span style='font-size:12px;'>[[title]] en [[category]]:<br><span style='font-size:20px;'>[[value]]</span> [[additional]] </span>",
            "fillAlphas": 1,
            "title": "Monto",
            "type": "column",
            "valueField": "monto",
            "dashLengthField": "dashLengthColumn"
        }, {
            "id": "graph2",
            "balloonText": "<span style='font-size:12px;'>[[title]] en [[category]]:<br><span style='font-size:20px;'>[[value]]</span> [[additional]] </span>",
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
