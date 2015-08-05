<?php
Route::get('/', 'WelcomeController@login');
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/








Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',








]);
Route::group(['middleware' => 'auth'], /**
     *
     */
    function(){

        Route::get('home', 'HomeController@index');
//rutas de referenciales simples de stock

        Route::resource ('lineas','ReferentialControllers\LineController');
        Route::resource ('presentaciones','ReferentialControllers\PresentationController');
        Route::resource ('unidades','ReferentialControllers\UnityController');
        Route::resource ('aromas','ReferentialControllers\AromaController');
        Route::resource ('proveedores','ReferentialControllers\ProviderController');
        Route::resource ('sucursales','ReferentialControllers\BranchController');

//rutas de referenciales simples de distribucion
        Route::resource ('ciudad','ReferentialControllers\CityController');
        Route::resource ('marcas','ReferentialControllers\BrandController');
        Route::resource ('rubros','ReferentialControllers\BusinessController');
        Route::resource ('cargos','ReferentialControllers\PositionController');
        Route::resource('zonas','ReferentialControllers\ZoneController');
        Route::resource('clientes','ReferentialControllers\ClientController');




    });