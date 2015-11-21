<?php namespace App\Providers;

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
            $role=\Auth::user()->role()->first()->description;
            $view->with('name',$name)->with('role',$role);
        });
        view()->composer('partials.slide',function ($view){
            $user=\Auth::user();
            $name=$user->name;
            $role=\Auth::user()->role()->first()->description;
            $view->with('name',$name)->with('role',$role);
        });

        view()->composer('app2',function ($view){
            $user=\Auth::user();
            $name=$user->name;
            $role=\Auth::user()->role()->first()->description;
            $view->with('name',$name)->with('role',$role);
        });
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
