<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\SortCatCanalesdistribucion;

class CanalesdistController extends Controller
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
        $canales = SortCatCanalesdistribucion::all();
        return view('Canalesdistribucion.index',['canales' => $canales]);
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
            if($request -> ajax()){
                   $Canalesdistribucion = new SortCatCanalesdistribucion;
                   $Canalesdistribucion->Nombre =  $request->Nombre;
                   $Canalesdistribucion->Comision = $request->Comision;
                   $Canalesdistribucion->save();
                   return response()->json([
                            $Canalesdistribucion
                    ]);
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
            $canal = SortCatCanalesdistribucion::find($request->idCanal);
                  return response()->json([
                   $canal
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
            if($request -> ajax()){
                   $Canalesdistribucion = SortCatCanalesdistribucion::find($request->Id);
                   $Canalesdistribucion->Nombre =  $request->Nombre;
                   $Canalesdistribucion->Comision = $request->Comision;
                   $Canalesdistribucion->save();
                   return response()->json([
                            $Canalesdistribucion
                    ]);
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
