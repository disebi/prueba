@extends('app2')


@section('bread')
  <h1>Sailda<small> # {{$out->id}}</small> </h1>
  <ol class="breadcrumb">
     <li><a href="/"><i class="fa fa-dashboard"></i>Home</a></li>
     <li><a href="/compras">Ordens</a></li>
   </ol>
@endsection
@section('content')

     <div class="panel panel-info">
       <div class="panel-heading">Salida #{{$out->id}} | Fecha: {{date_format($out->created_at,"d/m/Y")}}</div>
     <div class="panel-body">
     <div class="col-lg-6">
         <h4> Salida {{$out->id}}</h4>
         <p><b>Tanque: </b>{{number_format($out->tanque,0,',','.')}}</p>
         <p><b>Km: </b>{{number_format($out->km,0,',','.')}}</p>
         <p><b>Driver: </b>{{$out->driver->name.' '.$out->driver->last_name}}</p>
         <p><b>Vehiculo: </b>{{$out->drive->description}}</p>
         <p><b>Supervisor: </b>{{$out->staff->name.' '.$out->staff->last_name}}</p>
         <p><b>Razon: </b>
         @if($out->razon ==0)
         <span class="label label-warning"> Otro</span>
         @elseif($out->razon=1)
         <span class="label label-success"> Entrega  <a href="/remisiones/{{$out->razon_id}}">Nro {{$out->razon_id}}</a></span>
        @elseif($out->razon=2)
         <span class="label label-info"> Remision  <a href="/remisiones/{{$out->razon_id}}">Nro {{$out->razon_id}}</a></span>
         @endif
         </p>
         <p><b>Comentarios: </b>{{$out->comments}}</p>

     </div>
      </div>
      </div>



@endsection