<?php
Route::get('/', 'WelcomeController@login');
Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

Route::group(['middleware' => 'auth'],
    function(){

        Route::get('home', 'HomeController@index');
        Route::get('home2', 'HomeController@indexSales');
        Route::get('homeSalesmen/{id}', 'HomeController@salesmen');




//rutas de usuarios y roles
        Route::get ('perfil','UserController@edit');
        Route::patch ('perfilUp/{id}',  array('as' => 'perfilUp',
            'uses' => 'UserController@update'
        ));
        Route::resource ('roles','RoleController');
        Route::resource('permisos','LicenseController');
        Route::resource('usuarios','StaffController');
//rutas de referenciales simples de stock
        Route::resource ('lineas','ReferentialControllers\LineController');
        Route::post ('/lineasModal','ReferentialControllers\LineController@storeModal');
        Route::resource ('presentaciones','ReferentialControllers\PresentationController');
        Route::post ('/presentacionesModal','ReferentialControllers\PresentationController@storeModal');
        Route::resource ('unidades','ReferentialControllers\UnityController');
        Route::post ('/unidadesModal','ReferentialControllers\UnityController@storeModal');
        Route::resource ('aromas','ReferentialControllers\AromaController');
        Route::post ('/aromasModal','ReferentialControllers\AromaController@storeModal');
        Route::resource ('proveedores','ReferentialControllers\ProviderController');
        Route::post ('/proveedoresModal','ReferentialControllers\ProviderController@storeModal');
        Route::resource ('/sucursales','ReferentialControllers\BranchController');
        Route::post ('/sucursalesModal','ReferentialControllers\BranchController@storeModal');
        Route::resource ('impuestos','ReferentialControllers\TaxController');
        Route::post ('/impuestosModal','ReferentialControllers\TaxController@storeModal');
        Route::resource ('productos','ReferentialControllers\ProductController');
        Route::post ('/productosModal','ReferentialControllers\ProductController@storeModal');
        Route::resource ('/depositos','ReferentialControllers\DepositController');
//rutas de referenciales simples de distribucion
        Route::resource ('ciudad','ReferentialControllers\CityController');
        Route::post ('/ciudadModal','ReferentialControllers\CityController@storeModal');
        Route::resource ('marcas','ReferentialControllers\BrandController');
        Route::post ('/marcasModal','ReferentialControllers\BrandController@storeModal');
        Route::resource ('rubros','ReferentialControllers\BusinessController');
        Route::post ('rubros','ReferentialControllers\BusinessController@storeModal');
        Route::resource ('cargos','ReferentialControllers\PositionController');
        Route::resource('zonas','ReferentialControllers\ZoneController');
        Route::post ('/zonasModal','ReferentialControllers\ZoneController@storeModal');
        Route::resource('clientes','ReferentialControllers\ClientController');
        Route::resource('vehiculos','ReferentialControllers\DriveController');

    });