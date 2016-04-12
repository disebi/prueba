@section('css')
 <link href="{{ asset('/css/select2.css') }}" rel="stylesheet" type="text/css" />
 <link href="/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet">
@append
@section('javascripts')
<script src="/bootstrap3-editable/js/bootstrap-editable.js"></script>
<script type="text/javascript">
    $.fn.editable.defaults.params = function (params) {
        params._token = '{{csrf_token()}}';
        return params;
    };
</script>
@append