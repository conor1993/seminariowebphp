<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\WebCatGestores;
use App\WebCatCanalesdistribucion;

class GestoresController extends Controller
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
        return view('Gestores.index',['canales' => $canales],['gestores' => $gestores]);
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
        if ($request -> ajax()) {
            $gestores = new WebCatGestores;
            $gestores->Nombre  =  $request->Nombre;
            $gestores->ApellidoP  =  $request->ApellidoP;
            $gestores->ApellidoM  =  $request->ApellidoM;
            $gestores->Commission  =  $request->Commission;
            $gestores->IdCanaldistribucion  =  $request->Canaldis;
            $gestores->save();
            return  response()->json([$gestores]);
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
               $gestores =  WebCatGestores::find($request->idGestores);
                      return response()->json([
                      $gestores
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
        if ($request -> ajax()) {
            $gestores =  WebCatGestores::find($request->Id);
            $gestores->Nombre  =  $request->Nombre;
            $gestores->ApellidoP  =  $request->ApellidoP;
            $gestores->ApellidoM  =  $request->ApellidoM;
            $gestores->Commission  =  $request->Commission;
            $gestores->IdCanaldistribucion  =  $request->Canaldis;
            $gestores->save();
            return  response()->json([$gestores]);
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
