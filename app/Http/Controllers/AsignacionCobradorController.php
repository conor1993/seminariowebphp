<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\WebCatCobradores;
use App\WebAsignacionCobrador;


class AsignacionCobradorController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $cobradores = WebCatCobradores::all();
        $asignaciones = WebAsignacionCobrador::all();

         $asignaciones = DB::table('WebAsignacionCobrador')
                ->join('WebCatColaboradores', 'WebCatColaboradores.Id', '=', 'WebAsignacionCobrador.IdColaborador')
                ->join('WebCatCobradores', 'WebCatCobradores.Id', '=', 'WebAsignacionCobrador.IdCobrador')
                ->select('WebCatColaboradores.Id as idcol','WebCatCobradores.Id as idcob','WebCatColaboradores.Nombre as Nombrecol', 'WebCatCobradores.Nombre')->get();

        return view('AsignacionCobrador.index',['cobradores'=>$cobradores,'asignaciones'=>$asignaciones]);
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
       if ($request->ajax()) {

            if (WebAsignacionCobrador::where('IdCobrador', '=', $request->IdCobrador)->where('IdColaborador', '=', $request->IdColaborador)->count() > 0) {

                    $colaboradores = WebAsignacionCobrador::where('IdCobrador', '=', $request->IdCobrador)
                    ->where('IdColaborador', '=', $request->IdColaborador)
                    ->update(['IdColaborador' => $request->IdColaborador,'IdCobrador' =>$request->IdCobrador]);
                    return response()->json([$colaboradores]);

            }else{
              $colaboradores = new WebAsignacionCobrador;
              $colaboradores->IdCobrador =  $request->IdCobrador;
              $colaboradores->IdColaborador =  $request->IdColaborador;
              $colaboradores->save();
              return response()->json([$colaboradores]);
            }



        }
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
