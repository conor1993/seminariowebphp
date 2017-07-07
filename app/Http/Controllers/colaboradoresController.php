<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\WebCatCanalesdistribucion;
use App\WebCatGestores;
use App\SortCatEstados;
use App\SortCatMunicipios;
use App\SortCatLocalidades;
use App\WebCatColaboradores;

class colaboradoresController extends Controller
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

        $canales = WebCatCanalesdistribucion::all();
        $gestores = WebCatGestores::all();
        $estados  = SortCatEstados::all();
        $municipios =  SortCatMunicipios::where('idEstado', 25)->get();
        $localidades =  SortCatLocalidades::where('idMunicipio', 6)->get();

        return view('Colaboradores.index',['canales' => $canales,'gestores' => $gestores,'estados' => $estados,'municpios' =>$municipios,'localidades' =>$localidades]);

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
    public function store(Request $request)
    {
        if ($request->ajax()) {
              $colaboradores = new WebCatColaboradores;
              $colaboradores->Nombre             =  $request->Nombre;
              $colaboradores->ApellidoP          =  $request->ApellidoP;
              $colaboradores->ApellidoM          =  $request->ApellidoM;
              $colaboradores->IdGestor           =  $request->IdGestor;
              $colaboradores->IdCanaldis         =  $request->IdCanaldis;
              $colaboradores->Correspondecia     =  $request->Correspondecia;
              $colaboradores->Commission         =  $request->Commission;
              $colaboradores->Domicilio          =  $request->domicilio;
              $colaboradores->Cp                 =  $request->Cp;
              $colaboradores->Telefono           =  $request->Telefono;
              $colaboradores->IdEstado           =  $request->IdEstado;
              $colaboradores->Numeroint          =  $request->Numeroint;
              $colaboradores->NumeroExt          =  $request->NumeroExt;
              $colaboradores->IdMunicipio        =  $request->IdMunicipio;
              $colaboradores->IdLocalidad        =  $request->IdLocalidad;
              $colaboradores->Empresa            =  $request->Empresa;
              $colaboradores->PuestoEmpresa      =  $request->PuestoEmpresa;
              $colaboradores->DomiclioEmpresa    =  $request->DomiclioEmpresa;
              $colaboradores->Cpempresa          =  $request->Cpempresa;
              $colaboradores->NumerointEmpresa   =  $request->NumerointEmpresa;
              $colaboradores->NumeroextEmpresa   =  $request->NumeroextEmpresa;
              $colaboradores->IdEstadoEmpresa    =  $request->IdEstadoEmpresa;
              $colaboradores->TelefonoEmpresa    =  $request->TelefonoEmpresa;
              $colaboradores->IdmunicipioEmpresa =  $request->IdmunicipioEmpresa;
              $colaboradores->IdLocalidadEmpresa =  $request->IdLocalidadEmpresa;
              $colaboradores->save();
              return response()->json([$colaboradores]);
        }
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
                $colaboradores = WebCatColaboradores::find($request->id);
                      return response()->json([
                      $colaboradores
                    ]);
             }
    }
    public function shownombre(Request $request)
    {  
            if($request->ajax()){
                $colaboradores = DB::table('WebCatColaboradores as col')
                                ->join('WebSolicitudBoletos as sol ','col.Id','=','sol.IdColaborador')
                                ->select('col.*')
                                ->where('sol.Estatus', '=', 'A')
                                ->where('Nombre', 'like', $request->Nombre.'%')
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
    public function update(Request $request)
    {
        if ($request->ajax()) {
              $colaboradores =  WebCatColaboradores::find($request->id);
              $colaboradores->Nombre             =  $request->Nombre;
              $colaboradores->ApellidoP          =  $request->ApellidoP;
              $colaboradores->ApellidoM          =  $request->ApellidoM;
              $colaboradores->IdGestor           =  $request->IdGestor;
              $colaboradores->IdCanaldis         =  $request->IdCanaldis;
              $colaboradores->Correspondecia     =  $request->Correspondecia;
              $colaboradores->Commission         =  $request->Commission;
              $colaboradores->Domicilio          =  $request->domicilio;
              $colaboradores->Cp                 =  $request->Cp;
              $colaboradores->Telefono           =  $request->Telefono;
              $colaboradores->IdEstado           =  $request->IdEstado;
              $colaboradores->Numeroint          =  $request->Numeroint;
              $colaboradores->NumeroExt          =  $request->NumeroExt;
              $colaboradores->IdMunicipio        =  $request->IdMunicipio;
              $colaboradores->IdLocalidad        =  $request->IdLocalidad;
              $colaboradores->Empresa            =  $request->Empresa;
              $colaboradores->PuestoEmpresa      =  $request->PuestoEmpresa;
              $colaboradores->DomiclioEmpresa    =  $request->DomiclioEmpresa;
              $colaboradores->Cpempresa          =  $request->Cpempresa;
              $colaboradores->NumerointEmpresa   =  $request->NumerointEmpresa;
              $colaboradores->NumeroextEmpresa   =  $request->NumeroextEmpresa;
              $colaboradores->IdEstadoEmpresa    =  $request->IdEstadoEmpresa;
              $colaboradores->TelefonoEmpresa    =  $request->TelefonoEmpresa;
              $colaboradores->IdmunicipioEmpresa =  $request->IdmunicipioEmpresa;
              $colaboradores->IdLocalidadEmpresa =  $request->IdLocalidadEmpresa;
              $colaboradores->save();
              return response()->json([$colaboradores]);
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
