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

//-----------------------------------------------------------------------------------------------------------------------------------------------------
//--------------------------------------------------CATALOGOS------------------------------------------------------------------------------------------
//-----------------------------------------------------------------------------------------------------------------------------------------------------


		//RUTAS DE COLABORADORES
		Route::get('/colaboradores', 'ColaboradoresController@index');
		Route::post('/guardarColaboradores','ColaboradoresController@store');
		Route::post('/consultarColaboradores', 'ColaboradoresController@show');
		Route::post('/ActualizarColaboradores', 'ColaboradoresController@update');
		Route::post('/consultarColbaradorNombre', 'ColaboradoresController@shownombre');
		Route::post('/consultarColbaradorNombretodos', 'ColaboradoresController@shownombretodos');


		//RUTAS DE COBRADORES
		Route::get('/cobradores', 'CobradoresController@index');
		Route::post('/guardarCobradores','CobradoresController@store');
		Route::post('/consultarCobradores', 'CobradoresController@show');
		Route::post('/ActualizaRrCobradores', 'CobradoresController@update');


		//RUTAS DE CANALES DE DISTRIBUCION
		Route::get('/canalesdistribucion', 'CanalesdistController@index');
		Route::post('/guardarCanalDistribucion','CanalesdistController@store');
		Route::post('/consultarCanalDistribucion', 'CanalesdistController@show');
		Route::post('/ActualizaRrCanalDistribucion', 'CanalesdistController@update');

		//RUTAS DE GESTORES
		Route::get('/gestores', 'GestoresController@index');
		Route::post('/guardargestores','GestoresController@store');
		Route::post('/consultargestores', 'GestoresController@show');
		Route::post('/Actualizargestores', 'GestoresController@update');

		//RUTAS DE MUNICIPIOS
		Route::post('/ConsultarMunicipios', 'MunicipiosController@show');

		//RUTAS DE LOCALIDADES
		Route::post('/ConsultarLocalidades', 'LocalidadesController@show');
		
		//RUTAS DE FORMAS DE PAGO
		Route::get('/formaspagos', 'FormaspagosController@index');

		//RUTAS DE SORTEOS
		Route::get('/sorteos', 'SorteosController@index');
		Route::post('/guardarSorteos','SorteosController@store');
		Route::post('/consultarSorteos', 'SorteosController@show');
		Route::post('/ActualizarSorteos', 'SorteosController@update');

//-----------------------------------------------------------------------------------------------------------------------------------------------------
//--------------------------------------------------MOVIMIENTOS----------------------------------------------------------------------------------------
//-----------------------------------------------------------------------------------------------------------------------------------------------------

		//RUTAS DE SOLICITUD DE BOLETOS
		Route::get('/solicitudboletos', 'SolicitudDeBoletosController@index');
		Route::post('/guardarsolicitudboletos','SolicitudDeBoletosController@store');
		Route::post('/consultarsolicitudboletos', 'SolicitudDeBoletosController@show');
		Route::post('/Actualizarsolicitudboletos', 'SolicitudDeBoletosController@update');
		Route::post('/EditarEstatussolicitudboletos', 'SolicitudDeBoletosController@edit');
		//AUTORIZACION BOLETOS 
		Route::get('/autorizacionboletos', 'AutorizacionBoletosController@index');
		Route::post('/guardarautorizacionboletos','AutorizacionBoletosController@store');
		Route::post('/consultarautorizacionboletos', 'AutorizacionBoletosController@show');
		Route::post('/Actualizarautorizacionboletos', 'AutorizacionBoletosController@update');

		//BOLETOS
		Route::post('/validarBoletos','BoletosController@validarBoletos');

		//ASIGNACION DE BOLETOS
		Route::get('/asignacionboletos', 'AsignacionBoletosController@index');    

		//LIQUIDACION DE BOLETOS
		Route::get('/liquidacionboletos', 'LiquidacionBoletosController@index');
		Route::post('/guardarliquidacionboletos','LiquidacionBoletosController@store');
		Route::post('/consultarliquidacionboletos', 'LiquidacionBoletosController@show');
		Route::post('/Actualizarliquidacionboletos', 'LiquidacionBoletosController@update');

		//ASIGNACION DE COBRADORES
		Route::get('/asignacioncobradores', 'AsignacionCobradorController@index');
		Route::post('/guardarasignacioncobradores','AsignacionCobradorController@store');


//-----------------------------------------------------------------------------------------------------------------------------------------------------
//--------------------------------------------------REPORTES-------------------------------------------------------------------------------------------
//-----------------------------------------------------------------------------------------------------------------------------------------------------


		//REPORTE DE BOLETOS
		Route::get('/reporteboletos', 'ReporteBoletosController@index');
			//-----boletos liquidados
		Route::get('/crearpdfreporteboletos', 'ReporteBoletosController@store');
		Route::post('/consultarreporteboletos', 'ReporteBoletosController@show');
		Route::get('/crearpdfreporteboletosAsignados', 'ReporteBoletosController@showPdfAsignados');
		Route::post('/consultarboletosAsignados', 'ReporteBoletosController@showAsignados');
		Route::get('/crearpdfreporteboletosnoAsignados', 'ReporteBoletosController@showshowPdfnoasignados');


		//REPORTE DE COLABORADORES
		Route::get('/reportecolaboradores', 'ReporteColaboradoresController@index');
			//-----PENDIETES DE PAGO POR GESTOR
		Route::post('/consultarPendientesDePagoGestor', 'ReporteColaboradoresController@showpendientesporgestor');
		Route::get('/crearpdfreportependientesgestor', 'ReporteColaboradoresController@descargarpendientespdf');
			//-----PENDIENTES DE PAGO POR CANAl
		Route::post('/consultarPendientesDePagocanal', 'ReporteColaboradoresController@showpendientesporcanal');
		Route::get('/crearpdfPendientesDePagocanal', 'ReporteColaboradoresController@descargarpendientescanalpdf');


		//REPORTE DE MOVIMIENTOS
		Route::get('/reportemovimientos', 'ReporteMoviminetosController@index');



		
