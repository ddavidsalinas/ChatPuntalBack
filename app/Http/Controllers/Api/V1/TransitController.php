<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Transit;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Resources\V1\TransitResource;
class TransitController extends Controller
{
    /**
     * Display a listing of the resource.
     */


     public function cantidadtr(){
      
        
        $cantidad= Transit::count();
        return $cantidad;
     }


     public function estancia()
     {
 
 
         $cantidad = Transit::query()
             ->selectRaw('SUM(DATEDIFF(FinSalida, FechaEntrada)) AS estancia')
             ->value('estancia');
         $cantidadEstancias = Transit::count();
 
         if ($cantidadEstancias > 0) {
             $duracionMedia = $cantidad / $cantidadEstancias;
 
             $años = floor($duracionMedia / 365);
             $meses = floor(($duracionMedia % 365) / 30);
             $dias = $duracionMedia % 30;
             return ['años' => $años, 'meses' => $meses, 'días' => $dias];
         }
     }
 




// public function index(){


    
// $cositas = Transit::with(['plaza.pantalan.instalacion'])
// ->whereHas('plaza', function($query) {
//     $query->where('Estado', 'Disponible');
// })
// ->get();
// $plazasBaseAll=[

//     'plazabasedetalles' => TransitResource::collection($cositas)


// ] ;
//         return response()->json($plazasBaseAll, 201);
// }



     
    public function index()
    {
        // $transitos = Transit::with('administrativo', 'guardamuelles')->get();
        // $transitosConNombres = $transitos->map(function ($transito) {
        //     $guardamuellesNombre = User::find($transito->Guardamuelle_id)->NombreUsuario;
        //     $administrativoNombre = User::find($transito->Administrativo_id)->NombreUsuario;
        //     return [
                
        //         'Proposito' => $transito->Proposito,
        //         'Guardamuelle_id' => $transito->Guardamuelle_id, // ID del dock worker
        //         'Guardamuelle_nombre' => $guardamuellesNombre,
        //         'Autorizacion' => $transito->autorizacion,
        //         'AMarre_id' => $transito->Amarre_id,
        //         'Leido' => $transito->Leido,
        //         'Administrativo_id' => $transito->Administrativo_id, // ID del administrador
        //         'Administrativo_nombre' => $administrativoNombre,
         
        //         // 'created_at' => $transito->created_at,
        //         // 'updated_at' => $transito->updated_at,
        //     ];
        // });
        // return response()->json($transitosConNombres);
       
        return Transit::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $transit = Transit::create($request->all());
        $transit->save();
        return response()->json($transit, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $transit = Transit::find($id);

        if ($transit) {
            return response()->json($transit, 200);
        } else {
            return response()->json('Tránsito no encontrado', 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transit $transit)
    {
        try {
            // Verifica si el tránsito existe
            $transit = Transit::find($transit);
            if ($transit == null) {
                return response()->json([
                    'message' => 'No se encuentra el tránsito',
                    'code' => 404
                ], 404);
            }
            $transit->update($request->all());
            return response()->json([
                'data' => $transit,
                'code' => 200
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al actualizar el tránsito',
                'code' => 500
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $transit = Transit::find($id);

        if ($transit) {
            $transit->delete();
            return response()->json('Tránsito eliminado', 200);
        } else {
            return response()->json('Tránsito no encontrado', 404);
        }
    }
}
