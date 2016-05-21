@extends('app2')


@section('bread')
  <h1>Entrada<small> # {{$back->id}}</small> </h1>
  <ol class="breadcrumb">
     <li><a href="/"><i class="fa fa-dashboard"></i>Home</a></li>
     <li><a href="/compras">Ordens</a></li>
   </ol>
@endsection
@section('content')

     <div class="panel">
       <div class="panel-heading">Entrda #{{$back->id}} | Fecha: {{date_format($back->created_at,"d/m/Y")}}</div>
     <div class="panel-body">
     <div class="col-lg-6">
         <div class="callout callout-warning">
         <h4> Salida {{$back->out->id}}</h4>
         <p><b>Tanque: </b>{{number_format($back->out->tanque,0,',','.')}}</p>
         <p><b>Km: </b>{{number_format($back->out->km,0,',','.')}}</p>
         <p><b>Driver: </b>{{$back->out->driver->name.' '.$back->out->driver->last_name}}</p>
         <p><b>Vehiculo: </b>{{$back->out->drive->description}}</p>
         <p><b>Supervisor: </b>{{$back->out->staff->name.' '.$back->out->staff->last_name}}</p>
         <p><b>Comentarios: </b>{{$back->out->comments}}</p>
         </div>
     </div>

     <div class="col-lg-6">
          <div class="callout callout-success">
                   <h4> Entrada {{$back->id}}</h4>
                        <p><b>Tanque: </b>{{number_format($back->tanque,0,',','.')}}</p>
                            <p><b>Km: </b>{{number_format($back->km,0,',','.')}}</p>
                   <p><b>Supervisor: </b>{{$back->staff->name.' '.$back->staff->last_name}}</p>
                   <p><b>Comentarios: </b>{{$back->comments}}</p>
          </div>

     </div>

      </div>
      </div>



@endsection