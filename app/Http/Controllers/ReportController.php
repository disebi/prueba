<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Distribution\Sale;
use App\Models\ReferentialModels\Zone;
use App\Services\Reports;
use App\Staff;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use JasperPHP\JasperPHP;

class ReportController extends Controller {

  public function commission()
  {
     $staff = Staff::select(\DB::raw("staff.id, (staff.name || ' ' || staff.last_name) as description"))->branching()->lists('description', 'id');
     $input=\Input::all();
     if(isset($input['date_start'])){
         $report= new Reports($input);

         if(isset($input['download']))
              $report->commission_download();

         $result = $report->commission();
         if(isset($input['staff_list'])){
             $salesman = $input['staff_list'];
         }
         list($start, $end) = $this->getDates($input);
         return view('reports.commission',compact('staff','model','total_commission','start','end','salesman'))->with($result);
     }
      return view('reports.commission',compact('staff'));
  }
  public function salesman()
  {
     $input=\Input::all();
      if(isset($input['date_start'])){
          $report=new Reports($input);
          if(isset($input['download']))
              $report->salesman_download();
          $model = $report->salesman($input);
          list($start, $end) = $this->getDates($input);
             return view('reports.salesman',compact('model','start','end','salesman'));
         }
      return view('reports.salesman',compact('staff'));
  }

  public function visits(){
      $zones = Zone::all()->lists('description','id');
      $input=\Input::all();
      if(isset($input['date_start'])){
          $report= new Reports($input);
          if(isset($input['download']))
              $report->visits_download();
          $model = $report->visits();
          if(isset($input['zone_list'])){
              $zone = $input['zone_list'];
          }
          list($start, $end) = $this->getDates($input);
          return view('reports.visits',compact('zones','model','total_commission','start','end','zone'));
      }
      return view('reports.visits',compact('zones'));
  }

  public function orders(){
      $input=\Input::all();
      if(isset($input['date_start'])){
          $report=new Reports($input);
          if(isset($input['download']))
              $report->orders_download();
          $model = $report->orders($input);
          list($start, $end) = $this->getDates($input);
          return view('reports.orders',compact('model','start','end'));
      }
      return view('reports.orders');
}

    /**
     * @param $input
     * @return array
     */
    public function getDates($input)
    {
        if (isset($input['date_start'])) {
            $start = $input['date_start'];
        }
        if (isset($input['date_end'])) {
            $end = $input['date_end'];
            return array($start, $end);
        }
        return array($start, $end);
    }

}
