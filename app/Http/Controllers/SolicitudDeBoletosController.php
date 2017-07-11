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

class SolicitudDeBoletosController extends Controller
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
         $idcol = DB::select('select Id  from WebCatSorteo where (select max(fecha) from WebCatSorteo) = fecha');
         $canales =  WebCatCanalesdistribucion::all();
         $gestores =  WebCatGestores::all();
         $sorteos =  WebCatSorteo::all();
         return view('SolicitudDeBoletos.index',['canales'=>$canales,'gestores'=>$gestores,'sorteos'=>$sorteos,'idcol'=>$idcol]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {    



        //generar el folio ----------------------------------------------------------------------------------------
        $consecutivo = DB::table('WebFolioSolicitudes')->where('IdSorteo', $request->IdSorteo)->max('Consecutivo');
        $longitud = 5 - strlen($consecutivo);
        $longitudsort = 2 - strlen($request->IdSorteo);
        $cons = "";
        $sort="";
         //agregar ceros a la izquierda
         for ($i=0; $i < $longitud; $i++) { 
             $cons = $cons."0";
         }
          //agregar ceros a la izquierda
         for ($i=0; $i < $longitudsort; $i++) { 
             $sort = $sort."0";
         }
        $sort = $sort.$request->IdSorteo;
        $cons = $cons.$consecutivo;
        $Folio ='S'.$sort.$cons;
        //---------------------------------------------------------------------------------------------------------

        DB::table('WebFolioSolicitudes')->where('IdSorteo','=', $request->IdSorteo)->increment('Consecutivo');

         if($request->ajax()){
           $solicitud = new WebSolicitudBoletos;
           $solicitud->Folio = $Folio;
           $solicitud->IdColaborador = $request->IdColaborador;
           $solicitud->BoletosSolicitados = $request->BoletosSolicitados;
           $solicitud->BoletosAutorizados = $request->BoletosAutorizados;
           $solicitud->Estatus = $request->Estatus;
           $solicitud->IdSorteo = $request->IdSorteo;
           $solicitud->save();
           return response()->json([$solicitud]);
        }
        return $Folio;
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {        

            if($request ->ajax()){
               $solicitud = DB::table('WebSolicitudBoletos')
                    ->join('WebCatColaboradores', 'WebSolicitudBoletos.idcolaborador', '=', 'WebCatColaboradores.Id')
                    ->select('WebSolicitudBoletos.*', 'WebCatColaboradores.Nombre', 'WebCatColaboradores.ApellidoP', 'WebCatColaboradores.ApellidoM')
                    ->where('Folio', '=', $request->Folio)->get();
                      return response()->json([
                      $solicitud
                    ]);
             }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        if($request->ajax()){
            DB::beginTransaction();
                try {
                        $solicitud = WebSolicitudBoletos::find($request->Id);
                        $solicitud->Estatus = 'R';
                        $solicitud->save();
                } catch (Exception $e) {
                 DB::rollback();
                // $solicitud = $e->getMessage();
                 $solicitud = "404";
                }
            DB::commit();
        }
        return response()->json([$solicitud]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if($request->ajax()){
           $solicitud = WebSolicitudBoletos::find($request->Id);
           $solicitud->IdColaborador = $request->IdColaborador;
           $solicitud->BoletosSolicitados = $request->BoletosSolicitados;
           $solicitud->BoletosAutorizados = $request->BoletosAutorizados;
           $solicitud->Estatus = $request->Estatus;
           $solicitud->IdSorteo = $request->IdSorteo;
           $solicitud->save();
           return response()->json([$solicitud]);
        }
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

//$municipios =  SortCatMunicipios::where('idEstado', 25)->get();