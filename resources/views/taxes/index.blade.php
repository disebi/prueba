@extends('app2')

@section('content')

 @include('taxes.table',
           ['tabla'=>$tabla,
           'referencial'=>$referencial,
           'independiente'=>$independiente,
           'url'=>$url,
           'controlador'=>$controlador])

@stop

@section('javascripts')
<script type="text/javascript">
      $(function () {
        $("#tablalista").dataTable();

      });
    </script>


@include('partials.functionMsj')


@stop

