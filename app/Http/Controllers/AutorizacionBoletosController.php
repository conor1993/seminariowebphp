<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\WebCatCanalesdistribucion;
use App\WebCatGestores;
use App\WebCatSorteo;
use App\WebSolicitudBoletos;
use App\WebCatColaboradores;
use App\WebFolioSolicitudes;
use App\webdeudores;

class AutorizacionBoletosController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

         $sorteos =  WebCatSorteo::all();
         $idcol = DB::select('select Id  from WebCatSorteo where (select max(fecha) from WebCatSorteo) = fecha');
         $solicitudes = DB::table('WebSolicitudBoletos')
                ->join('WebCatColaboradores', 'WebSolicitudBoletos.idcolaborador', '=', 'WebCatColaboradores.Id')
                ->select('WebSolicitudBoletos.*', 'WebCatColaboradores.Nombre', 'WebCatColaboradores.ApellidoP', 'WebCatColaboradores.ApellidoM')
                ->where('Estatus', '=', 'V')->get();

         return view('AutorizacionBoletos.index',['sorteos'=>$sorteos,'solicitudes'=>$solicitudes,'idcol'=>$idcol]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
           //DATOS
           $bolets = $request->arregloBoletos;
           $sorteo = $request->sorteo; 
           $dataSet = [];
           $dataSetmov=[];
           $Idsolicitud =$request->Id;
           $fechaActual = date('Y-m-d');
           $IdColaborador = $request->idcolaborador;
           //LLENAR DATASET
            for ($i=0; $i < count($bolets) ; $i++) { 
                   $dataSet[] = [
                       'NumeroBoleto'  => $bolets[$i],
                        'IdSorteo' => $sorteo,
                        'IdSolicitud' => $request->idsolicitud,
                    ];

                $dataSetmov[] = [
                        'IdColaborador'  => $IdColaborador,
                        'NumeroBoleto' => $bolets[$i],
                        'IdSorteo' => $sorteo,
                        'IdTipoMovimiento'=>'ASIG',
                        'Fecha' => $fechaActual,
                ];

                   $boletos[$i]=$bolets[$i];
            }
            //COMEINZA TRANSACCION
            DB::beginTransaction();
            try {
                 //SE ACTUALIZA LA SOLICITUD AL ESTATUS DESEADO
                     $solicitud = WebSolicitudBoletos::find($request->Id);
                     $solicitud->BoletosAutorizados = $request->BoletosAutorizados;
                     $solicitud->Estatus = $request->Estatus;
                     $solicitud->save();
                //SE INSERTAN LAS ASIGNACIONDE DE LOS BOLETOS
                     $asignaciones = DB::table('WebAsignacionBoletos')->insert($dataSet);
                //CAMBIAR ESTATUS AL LOS BOLETOS SELECCIONODOS
                     DB::table('WebCatBoletos')->whereIn('NumeroBoleto',$boletos)->where('IdSorteo',$sorteo)->update(['Estatus' => 'A']);
                 //CALCULAR MONTO DE LOS BOLETOS
                     $monto= DB::table('WebCatSorteo')->where('Id', $request->IdSorteo)->select('Precio')->get();
                     $total = (int)$monto[0]->Precio * count($boletos);
                 //SE INSERTA EL COLABORADOR EN LA TABLA DE DEUORES
                     $deudor = new  webdeudores;
                     $deudor->Idsolicitud = $Idsolicitud;
                     $deudor->MontoAcordado = $total;
                     $deudor->FechaIngreso =date('Y-m-d');
                     $deudor->Estatus='V';
                     $deudor->save();
                 //SE REGISTRA EL MOVIMIENTO
                 DB::table('webmovdeudores')->insert($dataSetmov);

            }
            // ERROR DE LA TRANSACCION
            catch (\Exception $e)
            {
                 DB::rollback();
                 $solicitud = $e->getMessage();
                 //$solicitud = "404";
            }
            // FIN DE LA TRANSACCION
            DB::commit();

            return response()->json([$solicitud]);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
