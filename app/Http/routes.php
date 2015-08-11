<?php
Route::get('/', 'WelcomeController@login');
Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

Route::group(['middleware' => 'auth'],
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
        Route::post ('/ciudadModal','ReferentialControllers\CityController@storeModal');
        Route::resource ('marcas','ReferentialControllers\BrandController');
        Route::post ('/marcasModal','ReferentialControllers\BrandController@storeModal');
        Route::resource ('rubros','ReferentialControllers\BusinessController');
        Route::resource ('cargos','ReferentialControllers\PositionController');
        Route::resource('zonas','ReferentialControllers\ZoneController');
        Route::resource('clientes','ReferentialControllers\ClientController');
        Route::resource('vehiculos','ReferentialControllers\DriveController');

        Route::resource('permisos','LicenseController');
    });