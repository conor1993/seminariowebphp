<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// PAGINA PRINCIPAL
	Auth::routes();
	Route::get('/home', 'HomeController@index');

//	BIBLIOTECA
    //RUTAS DE AUTORES
	Route::get('/autores', 'autoresController@index');
	Route::post('/guardarAutor', 'autoresController@store');
	Route::post('/consultarAutor', 'autoresController@show');

///  SORTEO

		//RUTAS DE COLABORADORES
		Route::get('/colaboradores', 'ColaboradoresController@index');

		//RUTAS DE COBRADORES
		Route::get('/cobradores', 'CobradoresController@index');

		//RUTAS DE CANALES DE DISTRIBUCION
		Route::get('/canalesdistribucion', 'CanalesdistController@index');
		Route::post('/guardarCanalDistribucion','CanalesdistController@store');
		Route::post('/consultarCanalDistribucion', 'CanalesdistController@show');
		Route::post('/ActualizaRrCanalDistribucion', 'CanalesdistController@update');

		//RUTAS DE GESTORES
		Route::get('/gestores', 'GestoresController@index');

		//RUTAS DE FORMAS DE PAGO
		Route::get('/formaspagos', 'FormaspagosController@index');

		//RUTAS DE SORTEOS
		Route::get('/sorteos', 'SorteosController@index');

		//RUTAS DE SOLICITUD DE BOLETOS
		Route::get('/solicitudboletos', 'SolicitudDeBoletosController@index');

		//AUTORIZACION BOLETOS 
		Route::get('/autorizacionboletos', 'AutorizacionBoletosController@index');

		//ASIGNACION DE BOLETOS
		Route::get('/asignacionboletos', 'AsignacionBoletosController@index');    

		//LIQUIDACION DE BOLETOS
		Route::get('/liquidacionboletos', 'LiquidacionBoletosController@index');

		//REPORTE DE BOLETOS
		Route::get('/reporteboletos', 'ReporteBoletosController@index');

		//REPORTE DE COLABORADORES
		Route::get('/reportecolaboradores', 'ReporteColaboradoresController@index');

		//REPORTE DE MOVIMIENTOS
		Route::get('/reportemovimientos', 'ReporteMoviminetosController@index');

		
