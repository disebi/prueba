@extends('app2')


@section('bread')
  <h1>Orden<small> # {{$model->id}}</small> </h1>
  <ol class="breadcrumb">
     <li><a href="/"><i class="fa fa-dashboard"></i>Home</a></li>
     <li><a href="/compras">Ordens</a></li>
   </ol>

@endsection
@section('content')
<style>
.overme {
   white-space: nowrap;
  text-overflow: ellipsis;
  overflow: hidden;
}
</style>
    <div class="col-sm-12 invoice-info">
     <div class="panel panel-success">
                              <div class="panel-heading">Visita #{{$model->id}} | Fecha: {{date_format($model->created_at,"d/m/Y")}}</div>
                          <div class="panel-body">
        <div class="col-sm-4 invoice-col">
          Zona
          <address>
            <strong>{{$model->zone->description}}</strong><br>
           {{$model->zone->city->description}}<br>

          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          Vendedor
          <address>
            <strong>{{$model->staff->name}} {{$model->staff->last_name}}</strong><br>
           {{$model->staff->position->description}}<br>
            Sucursal: {{$model->staff->branch->description}}<br>
            Tel.   :{{$model->staff->tel}}<br>
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">

          <b>Visita ID:</b> {{$model->id}}<br>
          <b>Fecha de Visita:</b> {{date_format($model->created_at,"d/m/Y")}}<br>

        </div>
        <!-- /.col -->
      </div>
      </div>
      </div>


       @foreach(array_chunk($model->orders->all(),3) as $tablechunk)
        <div class="col-md-12">
              @foreach($tablechunk as $table)
               <div class="col-md-4">
    <div class="box box-primary">
                <div class="box-body box-profile">
                  <img class="profile-user-img img-responsive img-circle" src="/img/shop.png" alt="User profile picture">

                  <h3 class="profile-username text-center">{{$table->client->description}} <small> <a title="Editar Pedido" href="/ordenes/{{$table->id}}/edit" class=""><i class="fa fa-edit"></i></a></small> </h3>


                  <p class="text-muted text-center">{{$table->client->business->description}}</p>

                  <ul class="list-group list-group-unbordered">
                  @foreach($table->details as $detail)

                    <li class="list-group-item">
                      <b>{{$detail->cant}} - {{str_limit($detail->product->description, $limit = 25, $end = '...')}} </b> <a class="pull-right">
                      {{number_format($detail->price,0,'','.')}}
                      </a>
                    </li>
                 @endforeach
                  <li class="list-group-item">
                                     <b>Total</b> <a class="pull-right">{{number_format($table->total,0,'','.')}}</a>
                                     </li>
                  </ul>


                  <a href="/ordenes/{{$table->id}}" class="btn btn-primary btn-block"><b>Ver Pedido</b></a>
                </div>
                <!-- /.box-body -->
              </div>
              </div>
              @endforeach
              </div>
       @endforeach

@endsection