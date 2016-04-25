<?php namespace App\Http\Controllers\DistributionControllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Distribution\Visit;
use App\Models\Distribution\WorkOrder;
use Illuminate\Http\Request;

class WorkController extends Controller {


	public function index()
	{

        $model=WorkOrder::orderBy('updated_at','desc')
            ->branching()->active()->paginate(10);
        list($referencial, $independiente) = $this->getInfo();
        return view('workorder.index',compact('model','branches','referencial','independiente'));
	}

    public function search()
    {
        $model=Visit::orderBy('updated_at','desc')
            ->branching()
            ->where('state','=',true)->paginate(10);

        list($referencial, $independiente) = $this->getInfo();
        return view('workorder.searchVisit',compact('model','branches','referencial','independiente'));
    }

	public function create()
	{

	}

    public function makeOrder($id)
    {
        try{
            $user=\Auth::user();
            $model=Visit::find($id);
            list($referencial, $independiente) = $this->getInfo();
            return view('workorder.create',compact('model','order','clients','products','user','referencial','independiente'));
        }catch(\Exception $e){
            return redirect()->back()->with('message','El registro no existe')
                ->with('alert','error');
        }
    }
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

    public function getInfo()
    {
        $referencial = "Orden de Trabajo";
        $independiente = "Repartos";
        return array($referencial, $independiente);
    }
}
