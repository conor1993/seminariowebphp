<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\WebCatSorteo;
use App\WebCatCanalesdistribucion;
use App\WebCatGestores;
use PDF;

class ReporteColaboradoresController extends Controller
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
        $canal = WebCatCanalesdistribucion::all();
        $gestores = WebCatGestores::all();
         return view('ReporteColaboradores.index',['sorteos'=>$sorteos,'canal'=>$canal,'ges'=>$gestores]);
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
        //
    }

    //--------------------------------------pendientes de pago por gestor----------------------------------------------------------

    public function showpendientesporgestor(Request $request){

        $tiporept = $request->tiporep;

        if($request->ajax()){

                if($request->idgestor != '#'){
                    $pagosPendientes = DB::table('WebDeudores AS DED ')
                            ->join('WebSolicitudBoletos as sol' , 'sol.Id','=', 'ded.Idsolicitud')
                            ->join('WebCatColaboradores as col' , 'col.id','=','sol.IdColaborador')
                            ->join('WebCatGestores as ges','ges.id','=','col.IdGestor')
                            ->select('col.Nombre as colnombre','col.ApellidoP as colapellidop','col.ApellidoM as colapellidom','ges.Nombre as gestornombre','ges.ApellidoP as gesapellido','ges.ApellidoM as gesapellidom' ,'ded.MontoAcordado as pago')
                            ->where('ded.estatus','=','V')
                            ->where('ges.id','=',$request->idgestor)
                            ->where('sol.IdSorteo', '=', $request->idsorteo)->get();
                              return response()->json([
                              $pagosPendientes
                            ]);
                }else{
                    $pagosPendientes = DB::table('WebDeudores AS DED ')
                            ->join('WebSolicitudBoletos as sol' , 'sol.Id','=', 'ded.Idsolicitud')
                            ->join('WebCatColaboradores as col' , 'col.id','=','sol.IdColaborador')
                            ->join('WebCatGestores as ges','ges.id','=','col.IdGestor')
                            ->select('col.Nombre as colnombre','col.ApellidoP as colapellidop','col.ApellidoM as colapellidom','ges.Nombre as gestornombre','ges.ApellidoP as gesapellido','ges.ApellidoM as gesapellidom' ,'ded.MontoAcordado as pago')
                            ->where('ded.estatus','=','V')
                            ->where('sol.IdSorteo', '=', $request->idsorteo)->get();
                              return response()->json([
                              $pagosPendientes
                            ]);
                }



            }
    }
    

    public function descargarpendientespdf(Request $request){

            if($request->input("stlgestor") != '#'){
                $pagosPendientes = DB::table('WebDeudores AS DED')
                        ->join('WebSolicitudBoletos as sol' , 'sol.Id','=', 'ded.Idsolicitud')
                        ->join('WebCatColaboradores as col' , 'col.id','=','sol.IdColaborador')
                        ->join('WebCatGestores as ges','ges.id','=','col.IdGestor')
                        ->select('col.Nombre as colnombre','col.ApellidoP as colapellidop','col.ApellidoM as colapellidom','ges.Nombre as gestornombre','ges.ApellidoP as gesapellido','ges.ApellidoM as gesapellidom' ,'ded.MontoAcordado as pago')
                        ->where('ded.estatus','=','V')
                        ->where('ges.id','=',$request->input("stlgestor"))
                        ->where('sol.IdSorteo', '=', $request->input("stlsorteo"))->get();

                        $pdf = PDF::loadView('ReporteColaboradores.reportePendientesDePago',['pen'=>$pagosPendientes]);
                        return $pdf->download("archivo.pdf");
            }else{
                $pagosPendientes = DB::table('WebDeudores AS DED')
                        ->join('WebSolicitudBoletos as sol' , 'sol.Id','=', 'ded.Idsolicitud')
                        ->join('WebCatColaboradores as col' , 'col.id','=','sol.IdColaborador')
                        ->join('WebCatGestores as ges','ges.id','=','col.IdGestor')
                        ->select('col.Nombre as colnombre','col.ApellidoP as colapellidop','col.ApellidoM as colapellidom','ges.Nombre as gestornombre','ges.ApellidoP as gesapellido','ges.ApellidoM as gesapellidom' ,'ded.MontoAcordado as pago')
                        ->where('ded.estatus','=','V')
                        ->where('sol.IdSorteo', '=', $request->input("stlsorteo"))->get();

                        $pdf = PDF::loadView('ReporteColaboradores.reportePendientesDePago',['pen'=>$pagosPendientes]);
                        return $pdf->download("archivo.pdf");
            }



    }

    //--------------------------------------pendientes de pago por canal----------------------------------------------------------

    public function showpendientesporcanal(Request $request){

            if($request->ajax()){
                if($request->idcanal != '#'){
                    $pagosPendientes = DB::table('WebDeudores AS DED ')
                            ->join('WebSolicitudBoletos as sol' , 'sol.Id','=', 'ded.Idsolicitud')
                            ->join('WebCatColaboradores as col' , 'col.id','=','sol.IdColaborador')
                            ->join('WebCatCanalesdistribucion as can','can.id','=','col.IdCanaldis')
                            ->select('col.Nombre as colnombre','col.ApellidoP as colapellidop','col.ApellidoM as colapellidom','can.Nombre as canornombre','ded.MontoAcordado as pago')
                            ->where('ded.estatus','=','V')
                            ->where('can.id','=',$request->idcanal)
                            ->where('sol.IdSorteo', '=', $request->idsorteo)->get();
                              return response()->json([
                              $pagosPendientes
                            ]);
                }else{
                    $pagosPendientes = DB::table('WebDeudores AS DED ')
                            ->join('WebSolicitudBoletos as sol' , 'sol.Id','=', 'ded.Idsolicitud')
                            ->join('WebCatColaboradores as col' , 'col.id','=','sol.IdColaborador')
                            ->join('WebCatCanalesdistribucion as can','can.id','=','col.IdCanaldis')
                            ->select('col.Nombre as colnombre','col.ApellidoP as colapellidop','col.ApellidoM as colapellidom','can.Nombre as canornombre','ded.MontoAcordado as pago')
                            ->where('ded.estatus','=','V')
                            ->where('sol.IdSorteo', '=', $request->idsorteo)->get();
                              return response()->json([
                              $pagosPendientes
                            ]);
                }
            }

    }

    public function descargarpendientescanalpdf(Request $request){
                
                if($request->input("stlcanal") != '#'){
                    $pagosPendientes = DB::table('WebDeudores AS DED ')
                            ->join('WebSolicitudBoletos as sol' , 'sol.Id','=', 'ded.Idsolicitud')
                            ->join('WebCatColaboradores as col' , 'col.id','=','sol.IdColaborador')
                            ->join('WebCatCanalesdistribucion as can','can.id','=','col.IdCanaldis')
                            ->select('col.Nombre as colnombre','col.ApellidoP as colapellidop','col.ApellidoM as colapellidom','can.Nombre as canornombre','ded.MontoAcordado as pago')
                            ->where('ded.estatus','=','V')
                            ->where('can.id','=',$request->input("stlcanal"))
                            ->where('sol.IdSorteo', '=', $request->input("stlsorteo"))->get();

                            $pdf = PDF::loadView('ReporteColaboradores.reportependeintesdepagocanal',['pen'=>$pagosPendientes]);
                            return $pdf->download("archivo.pdf");
                }else{
                    $pagosPendientes = DB::table('WebDeudores AS DED ')
                            ->join('WebSolicitudBoletos as sol' , 'sol.Id','=', 'ded.Idsolicitud')
                            ->join('WebCatColaboradores as col' , 'col.id','=','sol.IdColaborador')
                            ->join('WebCatCanalesdistribucion as can','can.id','=','col.IdCanaldis')
                            ->select('col.Nombre as colnombre','col.ApellidoP as colapellidop','col.ApellidoM as colapellidom','can.Nombre as canornombre','ded.MontoAcordado as pago')
                            ->where('ded.estatus','=','V')
                            ->where('sol.IdSorteo', '=', $request->input("stlsorteo"))->get();

                            $pdf = PDF::loadView('ReporteColaboradores.reportependeintesdepagocanal',['pen'=>$pagosPendientes]);
                            return $pdf->download("archivo.pdf");
                }

    }

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
