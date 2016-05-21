<?php namespace App\Services;


use App\Models\Distribution\Sale;
use Carbon\Carbon;

class Reports {

    public function __construct($input)
    {
        $this->input = $input;
    }
    public function spread($sqlquery,$name,$head)
    {
        header( "Content-type: application/octet-stream");
        header( "Content-Disposition: attachment; filename=\"Reporte".$name . '_'.time( ) . ".csv\"");
        $data = "Reporte\n";
        $data = $data.$head."\n";
        foreach( $sqlquery as $row) {
            foreach( $row as $field) {
                $data .= $field.";";
            }
            $data .= "\n";
        }
        echo $data;
        die( );
    }

    function commission(){
        $input = $this->input;
        list($input, $date_to) = $this->getDateRange($input);

        $sql=Sale::branching()->active()->where('salesman_id','=',$input['staff_list'])
            ->where('created_at', '>=',$input['date_start'])
            ->where('created_at', '<=',$date_to->toDateString())
            ->paginate(40);

        $total=0;
        foreach ($sql as $sale){
            $total = $total + $sale->commission();
        }
        $array=[
            'total_commission'=>$total,
            'model' => $sql
        ];
        return $array;
    }

    function commission_download(){
        $input = $this->input;
        list($input, $date_to) = $this->getDateRange($input);
        $sql=\DB::table('sales')
            ->select(\DB::raw('staff.name, staff.last_name, sales.total, zones.description, zones.comision, (sales.total*zones.comision / 100) as ganancia ,sales.created_at'))
            ->where('salesman_id','=',$input['staff_list'])
            ->join('clients','sales.client_id', '=','clients.id')
            ->join('zones','clients.zona_id', '=','zones.id')
            ->join('staff','sales.salesman_id', '=','staff.id')
            ->where('sales.created_at', '>=',$input['date_start'])
            ->where('sales.created_at', '<=',$date_to->toDateString())
            ->where('sales.state', '=',true)
            ->where('sales.branch_id', '=',\Auth::user()->staff->branch_id)
            ->get();
        $this->spread($sql,'Comision',"Nombre;Apellido;Total;zona;porcentaje;ganancia; Fecha");
    }

    function salesman(){

        $input = $this->input;
        list($input, $date_to) = $this->getDateRange($input);

        $sql=\DB::table('sales')
            ->select(\DB::raw('staff.name, staff.last_name, sum(sales.total),count(sales.id) sales, count(visits.id) visits, count(distinct sales.client_id) as clients'))
            ->join('staff','sales.salesman_id', '=','staff.id')
            ->join('orders','sales.order_id', '=','orders.id')
            ->join('clients','orders.client_id', '=','clients.id')
            ->join('visits','orders.visit_id', '=','visits.id')
            ->join('zones','visits.zone_id', '=','zones.id')
            ->where('sales.state', '=',true)
            ->where('visits.state', '=',true)
            ->where('orders.state', '=',true)
            ->where('sales.created_at', '>=',$input['date_start'])
            ->where('sales.created_at', '<=',$date_to->toDateString())
            ->where('sales.branch_id', '=',\Auth::user()->staff->branch_id)
            ->groupBy('sales.salesman_id','staff.last_name','staff.name')
            ->paginate(40);
         return $sql;
    }

    function salesman_download(){
        $input = $this->input;
            if($input['date_start']=="")
                $input['date_start'] = Carbon::today()->hour(0)->minute(0)->second(0)->toDateString();
            if($input['date_end']=="")
                $input['date_end'] = Carbon::tomorrow()->hour(0)->minute(0)->second(0)->toDateString();
            $date_to=Carbon::createFromFormat('Y-m-d', $input['date_end'])->addDay(1)->hour(0)->minute(0)->second(0);

        $sql=\DB::table('sales')
            ->select(\DB::raw('staff.name, staff.last_name, sum(sales.total),count(sales.id) sales, count(visits.id) visits, count(distinct sales.client_id) as clients'))
            ->join('staff','sales.salesman_id', '=','staff.id')
            ->join('orders','sales.order_id', '=','orders.id')
            ->join('clients','orders.client_id', '=','clients.id')
            ->join('visits','orders.visit_id', '=','visits.id')
            ->join('zones','visits.zone_id', '=','zones.id')
            ->where('sales.state', '=',true)
            ->where('visits.state', '=',true)
            ->where('orders.state', '=',true)
            ->where('sales.created_at', '>=',$input['date_start'])
            ->where('sales.created_at', '<=',$date_to->toDateString())
            ->where('sales.branch_id', '=',\Auth::user()->staff->branch_id)
            ->groupBy('sales.salesman_id','staff.last_name','staff.name')
            ->get();
        $this->spread($sql,'Vendedores',"Nombre;Apellido;Total;Nro Ventas;Visitas;Clientes Vendidos");
    }

    function orders(){
        $input = $this->input;
        list($input, $date_to) = $this->getDateRange($input);

        $sql=\DB::table('orders')
            ->select(\DB::raw('orders.id, staff.name, staff.last_name, zones.description as zone, clients.description as client, orders.total, orders.process'))
            ->join('staff','orders.staff_id', '=','staff.id')
            ->join('clients','orders.client_id', '=','clients.id')
            ->join('zones','clients.zona_id', '=','zones.id')
            ->where('orders.state', '=',true)
            ->where('orders.created_at', '>=',$input['date_start'])
            ->where('orders.created_at', '<=',$date_to->toDateString())
            ->where('orders.branch_id', '=',\Auth::user()->staff->branch_id)
            ->paginate(40);
        return $sql;
    }

    function orders_download(){
        $input = $this->input;
        if($input['date_start']=="")
            $input['date_start'] = Carbon::today()->hour(0)->minute(0)->second(0)->toDateString();
        if($input['date_end']=="")
            $input['date_end'] = Carbon::tomorrow()->hour(0)->minute(0)->second(0)->toDateString();
        $date_to=Carbon::createFromFormat('Y-m-d', $input['date_end'])->addDay(1)->hour(0)->minute(0)->second(0);

        $sql=\DB::table('orders')
            ->select(\DB::raw('orders.id, staff.name, staff.last_name, zones.description as zone, clients.description as client, orders.total, orders.process'))
            ->join('staff','orders.staff_id', '=','staff.id')
            ->join('clients','orders.client_id', '=','clients.id')
            ->join('zones','clients.zona_id', '=','zones.id')
            ->where('orders.state', '=',true)
            ->where('orders.created_at', '>=',$input['date_start'])
            ->where('orders.created_at', '<=',$date_to->toDateString())
            ->where('orders.branch_id', '=',\Auth::user()->staff->branch_id)
            ->get();
        $this->spread($sql,'Ordenes',"Nombre;Apellido;Total;Nro Ventas;Visitas;Clientes Vendidos");
    }

    function visits(){
        $input = $this->input;
        list($input, $date_to) = $this->getDateRange($input);

        $sql=\DB::table('visits')
            ->select(\DB::raw('staff.name, staff.last_name, visits.id, zones.description as zone, count(orders.id) as orders, sum(orders.total) total, visits.process'))
            ->join('staff','visits.staff_id', '=','staff.id')
            ->join('orders','orders.visit_id', '=','visits.id')
            ->join('clients','orders.client_id', '=','clients.id')
            ->join('zones','clients.zona_id', '=','zones.id')
            ->where('visits.state', '=',true)
            ->where('visits.created_at', '>=',$input['date_start'])
            ->where('visits.created_at', '<=',$date_to->toDateString())
            ->where('visits.zone_id', '=',$input['zone_list'])
            ->where('visits.branch_id', '=',\Auth::user()->staff->branch_id)
            ->groupBy('staff.name','staff.last_name','visits.id','zones.description')
            ->paginate(40);
        return $sql;
    }

    function visits_download(){
        $input = $this->input;
        list($input, $date_to) = $this->getDateRange($input);

        $sql=\DB::table('visits')
            ->select(\DB::raw('visits.id,staff.name, staff.last_name, zones.description as zone, count(orders.id) as orders, sum(orders.total) total, visits.process'))
            ->join('staff','visits.staff_id', '=','staff.id')
            ->join('orders','orders.visit_id', '=','visits.id')
            ->join('clients','orders.client_id', '=','clients.id')
            ->join('zones','clients.zona_id', '=','zones.id')
            ->where('visits.state', '=',true)
            ->where('visits.created_at', '>=',$input['date_start'])
            ->where('visits.created_at', '<=',$date_to->toDateString())
            ->where('visits.zone_id', '=',$input['zone_list'])
            ->where('visits.branch_id', '=',\Auth::user()->staff->branch_id)
            ->groupBy('staff.name','staff.last_name','visits.id','zones.description')
            ->paginate(40);


        $this->spread($sql,'Visitas',"Visita;Nombre;Apellido;Zona;Nro Ordenes;Total;Process");
    }

    function remissions(){

        $input = $this->input;
        list($input, $date_to) = $this->getDateRange($input);

        $operation = $input['state'] == 4 ? '!=' : '=';
        $sql=\DB::table('remissions')
            ->select(\DB::raw('remissions.id, staff.name, staff.last_name ,staff_to.name nameto, branches.description branch, branch_to.description branchto, staff_to.last_name last_nameto, remissions.process, remissions.created_at'))
            ->join('staff','remissions.staff_id', '=','staff.id')
            ->join('staff as staff_to','remissions.staff_to', '=','staff_to.id')
            ->join('branches','remissions.branch_id', '=','branches.id')
            ->join('branches as branch_to','remissions.branch_to', '=','branch_to.id')
            ->where('remissions.created_at', '>=',$input['date_start'])
            ->where('remissions.created_at', '<=',$date_to->toDateString())
            ->where('remissions.branch_id', '=',\Auth::user()->staff->branch_id)
            ->where('remissions.process',$operation, $input['state'])
            ->paginate(40);
        return $sql;
    }

    function remissions_download(){
        $input = $this->input;
        list($input, $date_to) = $this->getDateRange($input);

        $operation = $input['state'] == 4 ? '!=' : '=';
        $sql=\DB::table('remissions')
            ->select(\DB::raw('remissions.id, staff.name, staff.last_name ,staff_to.name nameto, staff_to.last_name last_nameto, branches.description branch, branch_to.description branchto, remissions.process, remissions.created_at'))
            ->join('staff','remissions.staff_id', '=','staff.id')
            ->join('staff as staff_to','remissions.staff_to', '=','staff_to.id')
            ->join('branches','remissions.branch_id', '=','branches.id')
            ->join('branches as branch_to','remissions.branch_to', '=','branch_to.id')
            ->where('remissions.created_at', '>=',$input['date_start'])
            ->where('remissions.created_at', '<=',$date_to->toDateString())
            ->where('remissions.branch_id', '=',\Auth::user()->staff->branch_id)
            ->where('remissions.process',$operation, $input['state'])
            ->get();
        $this->spread($sql,'Remisiones',"Remision;Nombre;Apellido;Nombre Recibio; Apellido Recibio;Origen;Destino;Proceso;Fecha");
    }

    public function getDateRange($input)
    {
        if ($input['date_start'] == "")
            $input['date_start'] = Carbon::today()->hour(0)->minute(0)->second(0)->toDateString();
        if ($input['date_end'] == "")
            $input['date_end'] = Carbon::tomorrow()->hour(0)->minute(0)->second(0)->toDateString();
        $date_to = Carbon::createFromFormat('Y-m-d', $input['date_end'])->addDay(1)->hour(0)->minute(0)->second(0);
        return array($input, $date_to);
    }





}