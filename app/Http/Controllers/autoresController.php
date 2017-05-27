<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\BCatAutores;
use App\CatPaises;

class autoresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {   

        $autores = DB::table('BCatAutores')
            ->leftJoin('CatPaises', 'BCatAutores.IdPais', '=', 'CatPaises.Id')
            ->select('BCatAutores.Id', 'BCatAutores.Nombre as NombreAutor', 'CatPaises.Nombre')
            ->orderBy('NombreAutor', 'desc')
            ->get();
     
        $paises  = CatPaises::all();

        return view('Autores.index',['autores' => $autores],['paises' => $paises]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //s
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   

        if($request ->ajax()){
           $autores = new BCatAutores;
           $autores->Nombre = $request->Nombre;
           $autores->IdPais = $request->IdPais ;      
           $autores->save();
            return response()->json([
                   $autores
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
            $autor = BCatAutores::find($request->idAutor);
                  return response()->json([
                   $autor
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
