<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\WebCatSorteo;
use App\SortCatMunicipios;
use App\SortCatLocalidades;

class LiquidacionBoletosController extends Controller
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
         $municipios =  SortCatMunicipios::where('idEstado', 25)->get();
         $localidades =  SortCatLocalidades::where('idMunicipio', 6)->get();
         return view('LiquidacionDeBoletos.index',['sorteos'=>$sorteos,'municpios' =>$municipios,'localidades' =>$localidades]);
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        if($request->ajax()){
            $colaboradores = DB::table('webdeudores as ded')
                        ->join('websolicitudboletos as sol', 'ded.idsolicitud', '=', 'sol.id')
                        ->join('WebCatColaboradores as col', 'sol.IdColaborador', '=', 'col.id')
                        ->select('col.Nombre','col.ApellidoP','col.ApellidoM', 'col.Commission','col.Domicilio','col.Cp','col.Numeroint','col.IdMunicipio','col.NumeroExt','col.IdLocalidad','sol.Folio','ded.MontoAcordado','sol.BoletosAutorizados','ded.boletosdevueltos','ded.BoletosLiquidados')
                        ->where('col.id', '=', $request->idcol)
                        ->where('sol.IdSorteo', '=', $request->idsorteo)
                        ->get();
             return response()->json([$colaboradores]);
        }
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
