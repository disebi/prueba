<?php namespace App\Providers;

use App\Staff;
use Illuminate\Support\ServiceProvider;
use App\User;

class ViewComposerServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
        view()->composer('partials.navbar',function ($view){
            $user=\Auth::user();
            $name=$user->name;
            $userId=$user->id;
            $role=\Auth::user()->role()->first()->description;
            $view
                ->with('userId',$userId)
                ->with('name',$name)->with('role',$role);
        });
        view()->composer('partials.slide',function ($view){
            $user=\Auth::user();
            $name=$user->name;
            $role=\Auth::user()->role()->first()->description;
            $view

                ->with('name',$name)->with('role',$role);
        });

//        view()->composer('partials_invoice.userInfo',function ($view){
//            $user=\Auth::user();
//            $userId=$user->id;
//            $staff=Staff::where('user_id','=',$userId)->get();
//
//            $name=\Auth::user()->staff()->first()->name.' '.\Auth::user()->staff()->first()->name;
//            $role=\Auth::user()->role()->first()->description;
//            $view
//                ->with('name',$user)
//
//                ->with('role',$role);
//        });
	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}

}
