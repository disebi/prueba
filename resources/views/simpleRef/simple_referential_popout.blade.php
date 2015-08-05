


<script type="text/javascript">

$(document).ready(function() {

                    $("#"+"{{$idpop}}").editable({display:false});});
function sendM(){


var token= '{{csrf_token()}}';
var data={_token:token,
           description:document.getElementById("{{$modalreferential}}Modal").value,
           modal:'t'};


$.ajax({
            url: '{{ action("ReferentialControllers".$controllermodal."Controller@store") }}',
            type: 'POST',
            data:data}).done (function (data2){

            if(data2==0){
                 mensajito('error','El registro que intenta ingresar ya existe');

            }else{

                $("#"+"{{$comboBox}}").html("");

                //recorremos todas las filas del resultado del proceso que obtenemos en Json
                    $.each(data2, function(i,item){
                    //introducimos los option del Json obtenido
                   $("#"+"{{$comboBox}}").append("<option value="+item.id+">"+item.description+"</option>");
                    });
                mensajito('El registro fue guardado con exito','success');
            }
        });
 }








</script>