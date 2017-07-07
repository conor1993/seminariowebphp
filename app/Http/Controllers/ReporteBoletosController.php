<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\WebCatSorteo;
use PDF;

class ReporteBoletosController extends Controller
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
         return view('ReporteBoletos.index',['sorteos'=>$sorteos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //-------------------------------------------------------------------------------------------------------
    public function store(Request $request)
    {
              $solicitud = DB::table('WebDeudores AS DED')
                    ->join('WebAsignacionBoletos as SOL', 'sol.IdSolicitud', '=', 'DED.Idsolicitud')
                    ->join('WebSolicitudBoletos AS SOLI', 'SOLI.id', '=', 'ded.Idsolicitud')
                    ->join('WebCatColaboradores as col', 'col.id ', '=', 'soli.IdColaborador')
                    ->select('COL.Id','sol.NumeroBoleto', 'ded.FechaPago','COL.Nombre' , 'COL.ApellidoP' , 'COL.ApellidoM')
                    ->where('DED.Estatus', '=', 'P')
                    ->where('sol.IdSorteo', '=', $request->input("stlsorteo"))->get();

            $pdf = PDF::loadView('ReporteBoletos.reporteBoleto',['liq'=>$solicitud]);
            return $pdf->download("archivo.pdf");
    }

    public function show(Request $request)
    {

            if($request ->ajax()){
               $solicitud = DB::table('WebDeudores AS DED')
                    ->join('WebAsignacionBoletos as SOL', 'sol.IdSolicitud', '=', 'DED.Idsolicitud')
                    ->join('WebSolicitudBoletos AS SOLI', 'SOLI.id', '=', 'ded.Idsolicitud')
                    ->join('WebCatColaboradores as col', 'col.id ', '=', 'soli.IdColaborador')
                    ->select('sol.NumeroBoleto', 'ded.FechaPago','COL.Nombre' , 'COL.ApellidoP' , 'COL.ApellidoM')
                    ->where('DED.Estatus', '=', 'P')
                    ->where('sol.IdSorteo', '=', $request->idsorteo)->get();
                      return response()->json([
                      $solicitud
                    ]);
             }

    }    //-------------------------------------------------------------------------------------------------------
    public function showAsignados(Request $request)
    {

            if($request ->ajax()){
               $solicitud = DB::table('WebSolicitudBoletos')
                    ->join('WebAsignacionBoletos AS SOL', 'sol.IdSolicitud', '=', 'WebSolicitudBoletos.Id')
                    ->join('WebCatColaboradores AS COL', 'COL.Id', '=', 'WebSolicitudBoletos.IdColaborador')
                    ->select('COL.Id','sol.NumeroBoleto' , 'COL.Nombre' ,'COL.ApellidoP' , 'COL.ApellidoM')
                    ->where('WebSolicitudBoletos.Estatus', '=', 'A')
                    ->where('sol.IdSorteo', '=', $request->idsorteo)->get();
                      return response()->json([
                      $solicitud
                    ]);
             }

    }
  
    public function showPdfAsignados(Request $request)
    {
               $solicitud = DB::table('WebSolicitudBoletos')
                    ->join('WebAsignacionBoletos AS SOL', 'sol.IdSolicitud', '=', 'WebSolicitudBoletos.Id')
                    ->join('WebCatColaboradores AS COL', 'COL.Id', '=', 'WebSolicitudBoletos.IdColaborador')
                    ->select('COL.Id','sol.NumeroBoleto' , 'COL.Nombre' ,'COL.ApellidoP' , 'COL.ApellidoM')
                    ->where('WebSolicitudBoletos.Estatus', '=', 'A')
                    ->where('sol.IdSorteo', '=', $request->input("stlsorteo"))->get();

            $pdf = PDF::loadView('ReporteBoletos.reporteBoletosAsignados',['liq'=>$solicitud]);
            return $pdf->download("archivo.pdf");
    }

    //-------------------------------------------------------------------------------------------------------

    public function showshowPdfnoasignados(){
            $solicitud = DB::select("select NumeroBoleto from WebCatBoletos as bol  WHERE  Estatus = 'N' and bol.IdSorteo = 43");
            $pdf = PDF::loadView('ReporteBoletos.reporteBoletosnoasignados',['liq'=>$solicitud]);
            return $pdf->download("archivo.pdf");
    }

    public function showshownoasignados(){
            $solicitud = DB::select("select NumeroBoleto from WebCatBoletos as bol  WHERE  Estatus = 'N' and bol.IdSorteo = 39")->get();
              return response()->json([
                      $solicitud
                    ]);
    }
//-------------------------------------------------------------------------------------------------------
     
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
