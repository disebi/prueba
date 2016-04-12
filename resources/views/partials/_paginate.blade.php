@section('javascripts')
<!-- DATA TABES SCRIPT -->
    <script src="{{ URL::asset('/plugins/datatables/jquery.dataTables.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('/plugins/datatables/dataTables.bootstrap.js') }}" type="text/javascript"></script>

<script type="text/javascript">
      $(function () {
        $("#table").dataTable();
      });
    </script>
@append