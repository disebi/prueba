@extends('app2')


@section('bread')
  <h1>Ajuste<small> # {{$model->id}}</small> </h1>
  <ol class="breadcrumb">
     <li><a href="/"><i class="fa fa-dashboard"></i>Home</a></li>
     <li><a href="/ajustes">Ajuste</a></li>
   </ol>
@endsection
@section('content')

    <div class="col-sm-12 invoice-info">
     <div class="panel panel-success">
                          <div class="panel-heading">Compra #{{$model->id}} | Fecha: {{date_format($model->created_at,"d/m/Y")}}</div>
                          <div class="panel-body">
        <div class="col-sm-4 invoice-col">

        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          Usuario
          <address>
            <strong>{{$model->staff->name}} {{$model->staff->last_name}}</strong><br>
           {{$model->staff->position->description}}<br>
            Sucursal: {{$model->staff->branch->description}}<br>
            Tel.   :{{$model->staff->tel}}<br>

          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">

          <b>Compra ID:</b> {{$model->id}}<br>
          <b>Fecha de Compra:</b> {{date_format($model->created_at,"d/m/Y")}}<br>

        </div>
        <!-- /.col -->
      </div>
      </div>
      </div>

    <div class="col-sm-12 table-responsive">
     <div class="panel panel-success">
              <div class="panel-heading">Detalles</div>
              <div class="panel-body">
                                 <table class="table table-striped">
            <thead>
            <tr>
                      <th  class="col-md-1"  >#</th>
                                                          <th class="col-md-3" >Producto</th>
                                                          <th class="col-lg-2" style=" text-align: right" >Cant</th>
                                                          <th class="col-md-1" style="width:120px; text-align: right">Actividad</th>


            </tr>
            </thead>
            <tbody>
         @foreach($model->details as $detail)
                                                     <tr>
                                                     <td>{{$detail->product_id}}</td>
                                                     <td>{{$detail->product->description}}</td>
                                                     <td style="text-align: right">{{$detail->cant}}</td>
                                                     @if($detail->activity==0)      <td style="text-align: right">Suma     @else    Resta</td> @endif


           @endforeach
            </tbody>
          </table>
                           </div>
        </div>
      </div>

    <div class="col-sm-12">
         <div class="col-sm-6">
           <div class="panel panel-success">
                      <div class="panel-heading">Comentarios</div>
                      <div class="panel-body">
                            <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                                                                              {{$model->coment}}
                      </p>
                     </div>
           </div>
        </div>
         <div class="col-sm-6">
          <div class="panel panel-success">
               <div class="panel-heading">Totales</div>
               <div class="panel-body">
                                 <div class="table-responsive">
                    <table class="table">

                    <tr>
                                            <th>Excento</th>
                                            <td>{{number_format($model->exent,0,'','.')}}</td>
                                          </tr>
                      <tr>
                        <th>IVA (5%)</th>
                       <td>{{number_format($model->iva_5,0,'','.')}}</td>
                      </tr>
                      <tr>
                       <th>IVA (10%)</th>
                        <td>{{number_format($model->iva_10,0,'','.')}}</td>
                      </tr>
                      <tr>
                        <th>Total:</th>
                        <td>{{number_format($model->total,0,'','.')}}</td>
                      </tr>
                    </table>
                  </div>
                </div>
          </div>
         </div>
     </div>
@endsection