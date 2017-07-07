<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\WebCatCobradores;


class CobradoresController extends Controller
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
        $Cobradores =  WebCatCobradores::all();
        return view('Cobradores.index',['Cobradores' => $Cobradores]);
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
        if ($request-> ajax()) {
            $Cobradores = new WebCatCobradores;
            $Cobradores->Nombre = $request->Nombre;
            $Cobradores->ApellidoP = $request->Apellidop;
            $Cobradores->ApellidoM = $request->Apellidom;
            $Cobradores->Commission = $request->Commission;
            $Cobradores->Serie = $request->Serie;
            $Cobradores->save();
            return response()->json([$Cobradores]);
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
                $cobradores = WebCatCobradores::find($request->id);
                      return response()->json([
                      $cobradores
                    ]);
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
        if ($request-> ajax()) {
            $Cobradores =  WebCatCobradores::find($request->id);
            $Cobradores->Nombre = $request->Nombre;
            $Cobradores->ApellidoP = $request->Apellidop;
            $Cobradores->ApellidoM = $request->Apellidom;
            $Cobradores->Commission = $request->Commission;
            $Cobradores->Serie = $request->Serie;
            $Cobradores->save();
            return response()->json([$Cobradores]);
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
