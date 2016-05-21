@extends('app2')

@section('bread')
          <h1>
            Dashboard
            <small>Admin </small>
           </h1>

@endsection
@section('content')


  <div class="col-md-9">
    <div class="panel panel-success">
    				<div class="panel-heading">Informacion Semanal</div>
    				<div class="panel-body">
                    <div id="chartdiv" style="width : 100%; height : 250px;font-size	: 11px;"></div>
    				</div>
    			</div>


            <div class="col-md-4">
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
                       <div class="col-md-4">
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
                       <div class="col-md-4">
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
                                                                           <th>Orden</th>
                                                                           <th>Zona</th>
                                                                           <th>Estado</th>
                                                                           <th>Fecha</th>
                                                                         </tr>
                                                                         </thead>
                                                                         <tbody>
                                                                         @foreach($works as $work)
                                                                         <tr>
                                                                           <td><a href="/ordenes_trabajo/{{$work->id}}">{{$work->id}}</a></td>
                                                                           <td>{{$work->visit->zone->description}}</td>
                                                                           @if($work->process==0)
                                                                           <td><span class="label label-danger">En espera</span></td>
                                                                           @elseif($work->process==1)
                                                                           <td><span class="label label-success">Aceptado</span></td>
                                                                           @elseif($work->process==2)
                                                                           <td><span class="label label-success">Concluido</span></td>
                                                                           @endif
                                                                          <td> {{$work->created_at->format('d-m-Y')}} </td>
                                                                         </tr>
                                                                         @endforeach
                                                                         </tbody>
                                                                       </table>
                                                                     </div>
                                                                     <!-- /.table-responsive -->
                                                                   </div>
                                                                   <!-- /.box-body -->
                                                                  <div class="box-footer clearfix">
                                                                                <a href="/ordenes_trabajo/create" class="btn btn-sm btn-info btn-flat pull-left">Nueva Orden</a>
                                                                                <a href="/ordenes_trabajo" class="btn btn-sm btn-default btn-flat pull-right">Ver todas</a>
                                                                              </div>
                                                                              <!-- /.box-footer -->
                                                                            </div>
            </div>


           <!-- ./col -->

  </div>
  <div class="col-md-3">

    <div class="panel panel-warning">
      				<div class="panel-heading">Mejores Vendedores</div>
      				<div class="panel-body">
                         <h3>Top Vendedores</h3>
                          <p>A continuacion se muestra los mejores vendedores del mes:</p>
                          <table class="table table-condensed table-hover">
                            <thead>
                              <tr>
                                <th>Nombre</th>
                                <th>Venta</th>
                              </tr>
                            </thead>
                            <tbody>
                            @foreach($top as $salesman)
                              <tr>
                                <td><a href="/homeSalesmen/{{$salesman->id}}"> {{$salesman->name.' '.$salesman->last_name}}</a></td>
                                <td>{{number_format($salesman->sum,0,'','.')}}</td>

                              </tr>
                            @endforeach
                            </tbody>
                          </table>
      				</div>
      			</div>

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
  <div class="col-md-12">
 <div class="panel panel-success">
                              				<div class="panel-heading">Agenda</div>
                              				<div class="panel-body">

                                              <ul class="users-list clearfix">
                                              @foreach ($salesmen as $salesman)
                                                                  <li>
                                                                    <img src="/img/user.png"  height="90px" width="90px" alt="User Image">
                                                                    <a class="users-list-name" href="/homeSalesmen/{{$salesman->id}}">{{$salesman->name.' '.$salesman->last_name}}</a>
                                                                    <span class="users-list-date">{{$salesman->position->description}}</span>
                                                                  </li>
                                               @endforeach
                                              </ul>
                              				</div>
                              			</div>

</div>
@append

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

