<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
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
	public function edit()
	{
		$user=\Auth::user();;
        return view('auth.reset',compact('user'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Requests\EditUserRequest $request,$id)
	{

        $user=\Auth::user();;
        $obj=$request->all();

        $credentials = ['email'=>$obj['email'],
            'password'=>$obj['password'],
            'name'=>$obj['name']];

        $credentials['password'] = \Hash::make($credentials['password']);
        $user->update($credentials );

        $params = ['message'=>'Se ha guardado con exito',
            'alert'=>'success'];
        return redirect()->to('/home')->with($params);
	}


	public function destroy($id)
	{
		//
	}

    public function activate($id)
    {
        $user=User::find($id);
        $active=false;
        if(!$user->active){
            $active=true;
        }

        $user->active =$active;

        $user->save();


        return redirect()->to('/usuarios')->with('message','se cambio')->with('alert','success');


	}

}
