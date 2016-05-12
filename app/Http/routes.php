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
        Route::patch('activar/{id}',array('as' => 'usuarios.activeUser',
            'uses' => 'UserController@activate'
        ));
        //rutas de reportes
        Route::get('/reporte_visitas', 'ReportController@visits');
        Route::get('/reporte_ordenes', 'ReportController@orders');
        Route::get('/comisiones', 'ReportController@commission');
        Route::get('/reporte_vendedores', 'ReportController@salesman');

                //Distribucion
        Route::post('/asignaciones/searchAssign','DistributionControllers\ZoneAssignController@index');
        Route::resource('asignaciones','DistributionControllers\ZoneAssignController');
        Route::get('ordenes_visitas','DistributionControllers\OrderController@search');
        Route::get('makeOrder/{id}','DistributionControllers\OrderController@makeOrder');
        Route::resource('ordenes','DistributionControllers\OrderController');
        Route::get('makeWorkOrder/{id}','DistributionControllers\WorkController@makeOrder');
        Route::get('makeSale/{id}','DistributionControllers\SaleController@makeSale');
        Route::get('venta_ordenes','DistributionControllers\SaleController@search');
        Route::post('zones_info','DistributionControllers\VisitController@getZone');
        Route::get('ordenesTrabajo_visita','DistributionControllers\WorkController@search');
        Route::resource('ordenes_trabajo','DistributionControllers\WorkController');
        Route::resource('visitas','DistributionControllers\VisitController');
        Route::resource('ventas','DistributionControllers\SaleController');
        Route::get('makeBack/{id}','DistributionControllers\BackController@makeBack');
        Route::get('buscarSalidas','DistributionControllers\BackController@search');
        Route::resource('entradas','DistributionControllers\BackController');

        //STOCK
        Route::get('credito_ventas','StockControllers\CreditController@search');
        Route::resource('credito','StockControllers\CreditController');
        Route::get('makeCredit/{id}','StockControllers\CreditController@makeCredit');
        Route::get('existencias','StockControllers\AdjustController@download');
        Route::resource('ajustes','StockControllers\AdjustController');
        Route::resource('devoluciones','StockControllers\ReturnNoteController');
        Route::post ('/returnClient','StockControllers\ReturnNoteController@getClient');
        Route::resource('compras','StockControllers\PurchaseController');
        Route::post ('/returnProducts','StockControllers\PurchaseController@getProviderProduct');
        Route::post ('/returnProductPrice','StockControllers\PurchaseController@getProductPrice');

//rutas de referenciales simples de purchase
        Route::resource ('lineas','ReferentialControllers\LineController');
        Route::resource ('presentaciones','ReferentialControllers\PresentationController');
        Route::resource ('unidades','ReferentialControllers\UnityController');
        Route::resource ('aromas','ReferentialControllers\AromaController');
        Route::resource ('proveedores','ReferentialControllers\ProviderController');
        Route::resource ('/sucursales','ReferentialControllers\BranchController');
        Route::resource ('impuestos','ReferentialControllers\TaxController');
        Route::resource ('productos','ReferentialControllers\ProductController');
        Route::resource ('/depositos','ReferentialControllers\DepositController');
//rutas de referenciales simples de distribucion
        Route::resource ('ciudad','ReferentialControllers\CityController');
        Route::resource ('marcas','ReferentialControllers\BrandController');
        Route::resource ('rubros','ReferentialControllers\BusinessController');
        Route::resource ('cargos','ReferentialControllers\PositionController');
        Route::resource('zonas','ReferentialControllers\ZoneController');
        Route::resource('clientes','ReferentialControllers\ClientController');
        Route::resource('vehiculos','ReferentialControllers\DriveController');
        Route::resource('timbrados','ReferentialControllers\StampingController');



//rutas de modales
        Route::post ('/marcasModal','ModalController@brand');
        Route::post ('/rubrosModal','ModalController@buss');
        Route::post ('/lineasModal','ModalController@line');
        Route::post ('/proveedoresModal','ModalController@provider');
        Route::post ('/presentacionesModal','ModalController@presentation');
        Route::post ('/unidadesModal','ModalController@unity');
        Route::post ('/aromasModal','ModalController@aroma');


    });