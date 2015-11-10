@section('css')
 <link href="{{ asset('/css/select2.css') }}" rel="stylesheet" type="text/css" />
 <link href="/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet">
@append

<script type="text/javascript">
$.fn.editable.defaults.params = function (params) {
    params._token = '{{csrf_token()}}';
    return params;
};

$(document).ready(function() {
                    $("#"+"{{$idpop}}").editable({display:false,
                        name:'description',
                        type: 'text',
                        url: '{{ action("ReferentialControllers".$controllermodal."Controller@storeModal") }}',
                        pk: 1,
                        title: 'Enter username',
                        ajaxOptions: {
                            type: 'post'
                        },
                        success: function(response) {
                          if(response==0){
                              mensajito('error','El registro que intenta ingresar ya existe');
                          }else{
                               $("#"+"{{$comboBox}}").html("");
                               $("#"+"{{$comboBox}}").append("<option value=0>Seleccionar</option>");
                              //recorremos todas las filas del resultado del proceso que obtenemos en Json
                              $.each(response, function(i,item){
                              //introducimos los option del Json obtenido
                              $("#"+"{{$comboBox}}").append("<option value="+item.id+">"+item.description+"</option>");
                              });
                             // $("#"+"{{$comboBox}}").select2({val:1}).trigger("change");
                              var valor=response.length-1;
                              $("#"+"{{$comboBox}}").val(response[valor]['id']).trigger("change");

                               mensajito('success','El registro fue guardado con exito');

                          }
                        }
                    });});
</script>

@section('javascripts')
    <script src="/bootstrap3-editable/js/bootstrap-editable.js"></script>
@append