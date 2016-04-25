<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Distribution\Sale;
use App\Staff;
use Carbon\Carbon;
use Illuminate\Http\Request;
use JasperPHP\JasperPHP;

class ReportController extends Controller {


  public function commission()
  {
     $staff = Staff::select(\DB::raw("staff.id, (staff.name || ' ' || staff.last_name) as description"))->branching()->lists('description', 'id');
     $input=\Input::all();

     if(isset($input['date_start'])){
            if($input['date_start']=="")
                $input['date_start'] = Carbon::today()->hour(0)->minute(0)->second(0)->toDateString();
         if($input['date_end']=="")
                $input['date_end'] = Carbon::tomorrow()->hour(0)->minute(0)->second(0)->toDateString();
         $date_to=Carbon::createFromFormat('Y-m-d', $input['date_end'])->addDay(1)->hour(0)->minute(0)->second(0);

         $model=Sale::branching()->active()->where('salesman_id','=',$input['staff_list'])
              ->where('created_at', '>=',$input['date_start'])
              ->where('created_at', '<=',$date_to->toDateString())
              ->paginate(10);
          $total_commission=0;
         foreach ($model as $sale){
             $total_commission = $total_commission + $sale->commission();
         }
         return view('reports.commission',compact('staff','model','total_commission'));
     }
     return view('reports.commission',compact('staff'));
  }

}
