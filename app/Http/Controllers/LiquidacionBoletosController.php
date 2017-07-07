<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\WebCatSorteo;
use App\SortCatMunicipios;
use App\SortCatLocalidades;
use App\webdeudores;
use App\webmovdeudores;

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
        DB::beginTransaction();
        try {

            //SEACTUALIZA LA DEUDA
                $deudor =   webdeudores::find($request->Id);
                $deudor->MontoPagado= $deudor->MontoAcordado;
                $deudor->FechaPago = date("d/m/Y");
                $deudor->Estatus='P';
                $deudor->BoletosDevueltos=0;
                $deudor->BoletosLiquidados=$request->entregados;
                $deudor->save();
                  $mesagge = "";
            // 
            
        } catch (\Exception $e) {
            DB::rollback();
            $mesagge = $e->getMessage();
            //$mesagge = "404";
        }

        DB::commit();
        return response()->json([$mesagge]);
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
           $colaboradores = DB::select('select ded.Id,asg.NumeroBoleto ,sol.IdColaborador ,col.Nombre,col.ApellidoP,col.ApellidoM, col.Commission,col.Domicilio,col.Cp,col.Numeroint,col.IdMunicipio,col.NumeroExt,col.IdLocalidad,
               sol.Folio,ded.MontoAcordado,sol.BoletosAutorizados,ded.boletosdevueltos,ded.BoletosLiquidados
               from 
                webdeudores as ded join websolicitudboletos as sol on ded.idsolicitud = sol.id
                join WebCatColaboradores as col on sol.IdColaborador = col.id
                join WebAsignacionBoletos asg on asg.IdSolicitud = sol.id and asg.IdSorteo = sol.IdSorteo
                where col.id = '.$request->idcol.' and sol.IdSorteo ='.$request->idsorteo.'
                order by sol.IdColaborador, asg.NumeroBoleto');

            /*$colaboradores = DB::table('webdeudores as ded')
                        ->join('websolicitudboletos as sol', 'ded.idsolicitud', '=', 'sol.id')
                        ->join('WebCatColaboradores as col', 'sol.IdColaborador', '=', 'col.id')
                        ->join('WebAsignacionBoletos as asg','asg.IdSolicitud', '=', 'sol.id')
                        ->select('sol.IdColaborador ','col.Nombre','col.ApellidoP','col.ApellidoM', 'col.Commission','col.Domicilio','col.Cp','col.Numeroint','col.IdMunicipio','col.NumeroExt','col.IdLocalidad','sol.Folio','ded.MontoAcordado','sol.BoletosAutorizados','ded.boletosdevueltos','ded.BoletosLiquidados')
                        ->where('col.id', '=', $request->idcol)
                        ->where('sol.IdSorteo', '=', $request->idsorteo)
                        ->get();
            */
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
        //VARIABLES
            $bols = $request->arregloBoletos;
            $sorteo = $request->sorteo;
            $bolsdev = $request->cantLiquidar;
            $boletos = [];
            $datasetBoletos = [];
            $fechaActual = date("d/m/Y");
            $IdColaborador = $request->idcolaborador;
        //OBTENEMOS EL ARREGLO DE BOLETOS K SE ACTUALIZARAN
            for ($i=0; $i <count($bols) ; $i++) { 
                $boletos[$i] = $bols[$i];
                $dataSet[] = [
                        'IdColaborador'  => $IdColaborador,
                        'NumeroBoleto' => $bols[$i],
                        'IdSorteo' => $request->sorteo,
                        'IdTipoMovimiento'=>'DEVO',
                        'Fecha' => $fechaActual,
                ];
            }

        //INIVIA LA TRANSACCION
            DB::beginTransaction();
            try {
                //CALCULAR EL MONTO PAGADO
                $monto= DB::table('WebCatSorteo')->where('Id', $request->sorteo)->select('Precio')->get();
                $total = (int)$monto[0]->Precio * (int)$bolsdev;
                //SE ACTUALIZAN LOS BOLETOS A ESTATUS VIEJENTE
                DB::table('WebCatBoletos')->whereIn('NumeroBoleto',$boletos)->where('IdSorteo',$sorteo)->update(['Estatus' => 'N']);
                //SE ACTUALIZA LA DEUDA
                $deudor =   webdeudores::find($request->Id);
                $deudor->MontoPagado=$total;
                $deudor->FechaPago = date("d/m/Y");
                $deudor->Estatus='P';
                $deudor->BoletosDevueltos=count($bols);
                $deudor->BoletosLiquidados=$bolsdev;
                $deudor->save();
                //ELIMINAR ASIGNACIONES 
                DB::table('WebAsignacionBoletos')->whereIn('NumeroBoleto',$boletos)->where('IdSorteo',$sorteo)->delete();
                //SE REGISTRA LOS MOVIMIENTOS
                DB::table('webmovdeudores')->insert($dataSet);
                //MOVIMIENSTO DE LIQUIDACION 
                $message ="";

            } catch (\Exception $e) {
                DB::rollback();
                 $message = $e->getMessage();
                 //$solicitud = "404";
            }
            DB::commit();
            return response()->json([$message]);
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
