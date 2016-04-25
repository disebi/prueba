@section('bread')
          <h1>
            Editar Registro de {{$referencial}}
            <small>de {{$independiente}}
            </small>
           </h1>
  <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> {{$referencial}}</a></li>
            <li><a href="#">{{$independiente}}</a></li>
   </ol>
@endsection