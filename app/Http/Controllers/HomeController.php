<?php namespace App\Http\Controllers;

use App\Models\Distribution\Order;
use App\Models\Distribution\Visit;
use App\Models\Stock\Purchase;
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
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{

        $user=\Auth::user();
        $order_count=Order::join('visits','visits.id','=','orders.visit_id')
            ->where('visits.branch_id','=',$user->staff->branch_id)
            ->where('orders.state','=',true)
            ->where('orders.created_at', '>=', Carbon::now()->startOfMonth())
            ->count();
        $visit_count=Visit::where('visits.branch_id','=',$user->staff->branch_id)
            ->where('visits.created_at', '>=', Carbon::now()->startOfMonth())
            ->where('visits.state','=',true)
            ->count();

        $buys=Purchase::where('purchases.created_at', '>=', Carbon::today())
            ->where('purchases.created_at', '<', Carbon::tomorrow())
            ->where('purchases.branch_id','=',$user->staff->branch_id)
            ->where('purchases.state','=',true)
            ->orderBy('purchases.id', 'desc')
            ->take(5)->get();
		return view('dashboard.superDashboard',compact('order_count','visit_count','buys'));
	}
    public function indexSales()
	{
		return view('dashboard.superDashboard2');
	}

    public function salesmen()
    {
        return view('dashboard.salesmen');
    }

}
