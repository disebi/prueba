@section('bread')
          <h1>
            {{$referencial}}
            <small>de {{$independiente}}
            @if(isset($button))
                <a class="btn btn-success" href="{{$button}}"><i class="fa fa-plus"></i> Nuevo</a>
             @endif
            </small>
           </h1>
  <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> {{$referencial}}</a></li>
            <li><a href="#">{{$independiente}}</a></li>
   </ol>
@endsection