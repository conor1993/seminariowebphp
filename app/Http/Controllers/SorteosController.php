<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\WebCatSorteo;

class SorteosController extends Controller
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
        $sorteos = WebCatSorteo::all();
        return view('Sorteos.index',['sorteos' => $sorteos]);
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
        DB::beginTransaction();
            try {
                    if($request -> ajax()){
                           $Sorteos = new WebCatSorteo;
                           $Sorteos->Nombre =  $request->Nombre;
                           $Sorteos->Precio = $request->Precio;
                           $Sorteos->NumeroPorBoleto = $request->Numeroporboleto;
                           $Sorteos->Fecha = $request->Fechainicial;
                           $Sorteos->FechaLimite = $request->Fechalimite;
                           $Sorteos->CantidadBoletos = $request->CantidadBoletos;
                           $Sorteos->save();
                    }
                    //creamos el arreglo de boletos
                    $cantidadBoletos = $request->CantidadBoletos+1;
                    $folioinicia     = $request->Folioinc;
                    $dataSet = [];
                    for ($i=0; $i < $cantidadBoletos ; $i++) { 
                            $dataSet[] = [
                                'NumeroBoleto'  => $folioinicia,
                                'Estatus'    => 'N',
                                'IdSorteo' => $Sorteos->Id,
                            ];
                            $folioinicia = $folioinicia+1;
                            if(count($dataSet) == 499){
                                 DB::table('WebCatBoletos')->insert($dataSet);
                                 $dataSet =[];
                            }
                    }
                    DB::table('WebCatBoletos')->insert($dataSet);
            }catch (\Exception $e) {
                 DB::rollback();
                 //$Sorteos = $e->getMessage();
                 $Sorteos = "404";
            }

        DB::commit();
        return  response()->json([$Sorteos]);

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
                $sorteo = WebCatSorteo::find($request->idSorteo);
                      return response()->json([
                      $sorteo
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
                   $Sorteos = WebCatSorteo::find($request->Id);
                   $Sorteos->Nombre =  $request->Nombre;
                   $Sorteos->Precio = $request->Precio;
                   $Sorteos->NumeroPorBoleto = $request->Numeroporboleto;
                   $Sorteos->Fecha = $request->Fechainicial;
                   $Sorteos->FechaLimite = $request->Fechalimite;
                   $Sorteos->CantidadBoletos = $request->CantidadBoletos;
                   $Sorteos->save();
                   return response()->json([
                            $Sorteos
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
