<?php namespace App\Http\Controllers;

use App\Models\Distribution\Order;
use App\Models\Distribution\Sale;
use App\Models\Distribution\Visit;
use App\Models\Distribution\WorkOrder;
use App\Models\ReferentialModels\Branch;
use App\Models\Stock\Purchase;
use App\Staff;
use Carbon\Carbon;

class HomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
        $this->admin = \Auth::user()->hasAccess('back.all');
        $this->salesman = \Auth::user()->hasAccess('back.all');
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
        if(!$this->admin)
            return view('app2');


        $user=\Auth::user();
        $today=Carbon::today();
        $order_count=Order::join('visits','visits.id','=','orders.visit_id')
            ->where('visits.branch_id','=',$user->staff->branch_id)
            ->where('orders.state','=',true)
            ->where('orders.created_at', '>=', Carbon::now()->startOfMonth())
            ->count();
        $visit_count=Visit::where('visits.branch_id','=',$user->staff->branch_id)
            ->where('visits.created_at', '>=', Carbon::now()->startOfMonth())
            ->where('visits.state','=',true)
            ->count();

        $buys=Purchase::where('purchases.created_at', '>=',  Carbon::now()->startOfMonth())
            ->where('purchases.created_at', '<', Carbon::tomorrow())
            ->where('purchases.branch_id','=',$user->staff->branch_id)
            ->where('purchases.state','=',true)
            ->orderBy('purchases.created_at', 'desc')
            ->take(5)->get();
            $days=Carbon::now()->daysInMonth;
        $works = WorkOrder::where('work_orders.created_at', '>=',  Carbon::now()->startOfMonth())
            ->where('work_orders.created_at', '<', Carbon::tomorrow())
            ->branching()->active()
            ->orderBy('work_orders.created_at', 'desc')
            ->take(10)->get();
        $sale_count=Sale::where('sales.branch_id','=',$user->staff->branch_id)
            ->where('sales.created_at', '>=', Carbon::now()->startOfMonth())
            ->where('sales.state','=',true)
            ->count();
        $top=Sale::select(\DB::raw('sum(total),staff.name,staff.last_name,sales.salesman_id'))
            ->join('staff','sales.salesman_id','=','staff.id')
            ->where('sales.created_at', '>=',  Carbon::now()->startOfMonth())
            ->where('sales.created_at', '<', Carbon::tomorrow())
            ->branching()
            ->where('sales.state','=',true)
            ->groupBy('sales.salesman_id','staff.name','staff.last_name')
            ->orderBy('sum','desc')
            ->get(10);
        $monthSales=Sale::select(\DB::raw('created_at::date, sum(total)'))
            ->where('sales.created_at', '>=',  Carbon::now()->startOfMonth())
            ->where('sales.created_at', '<', Carbon::tomorrow())
            ->branching()
            ->where('sales.state','=',true)
            ->orderBy('sales.created_at', 'asc')
            ->groupBy('created_at')
            ->lists('sum','created_at');
        $month = array_fill(0, $days, 0);
        foreach($monthSales as $key=>$day){
            $timestamp = date("d", strtotime($key));
            $month[intval($timestamp)-1] = intval($day);
        }
        $branch = Branch::find($user->staff->branch_id);
        $obj = $branch->objective();
        $salesmen = $branch->staff;
		return view('dashboard.superDashboard',compact('works','top','sale_count','order_count','obj','visit_count','buys','salesmen','month'));
	}


    public function salesmen($id)
    {
        if(!$this->salesman && !$this->admin)
            return view('app2');
        $staff=Staff::find($id);

        $order_count=Order::join('visits','visits.id','=','orders.visit_id')
            ->where('visits.branch_id','=',$staff->branch_id)
            ->where('orders.state','=',true)
            ->where('orders.staff_id','=',$id)
            ->where('orders.created_at', '>=', Carbon::now()->startOfMonth())
            ->count();
        $visit_count=Visit::where('visits.branch_id','=',$staff->branch_id)
            ->where('visits.created_at', '>=', Carbon::now()->startOfMonth())
            ->where('visits.state','=',true)
            ->where('visits.staff_id','=',$id)
            ->count();
        $sale_count=Sale::where('sales.branch_id','=',$staff->branch_id)
            ->where('sales.created_at', '>=', Carbon::now()->startOfMonth())
            ->where('sales.state','=',true)
            ->where('sales.staff_id','=',$id)
            ->count();


        $days=Carbon::now()->daysInMonth;
        $monthSales=Sale::select(\DB::raw('created_at::date, sum(total)'))
            ->where('sales.created_at', '>=',  Carbon::now()->startOfMonth())
            ->where('sales.created_at', '<', Carbon::tomorrow())
            ->branching()
            ->where('sales.state','=',true)
            ->orderBy('sales.created_at', 'asc')
            ->where('sales.salesman_id','=',$id)
            ->groupBy('created_at')
            ->lists('sum','created_at');
        $month = array_fill(0, $days, 0);

        $sql=Sale::branching()->active()->where('salesman_id','=',$id)
            ->where('created_at', '>=',Carbon::now()->startOfMonth())
            ->where('created_at', '<=',Carbon::tomorrow())
            ->get();

        $total=0;
        foreach ($sql as $sale){
            $total = $total + $sale->commission();
        }
        foreach($monthSales as $key=>$day){
            $timestamp = date("d", strtotime($key));
            $month[intval($timestamp)-1] = intval($day);
            $total = $total + $sale->commission();
        }
        $obj = $staff->objective();
        return view('dashboard.salesmen',compact('staff','total','works','order_count','sale_count','obj','visit_count','buys','salesmen','month'));
    }

}
