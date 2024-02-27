<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Incident;
use Illuminate\Http\Request;
use App\Http\Resources\V1\IncidentsResource;

class IncidentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Incident::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // dd($request->all());


        // Crea una nueva instancia de Incidencia con los datos del request
        $incident = new Incident([
            'Titulo' => $request->Titulo,
            'Descripcion' => $request->Descripcion,
        ]);
    
        // Verifica si se envió una imagen y la almacena si es así
        if ($request->hasFile('Imagen')) {
            $imagenPath = $request->file('Imagen')->store('public/image');
            // Obtén la URL pública de la imagen almacenada
            $url = Storage::url($imagenPath);
            // Asigna la URL al atributo Imagen del modelo Incident
            $incident->Imagen = $url;
        }
    
        // Guarda la incidencia en la base de datos
        $incident->save();
    
        // Retorna la incidencia como JSON con código de estado 201 (Created)
        return response()->json($incident, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $incident = Incident::find($id);

        if ($incident) {
            return new IncidentController($incident);
            // return response()->json($incident, 200);
        } else {
            return response()->json('Incidente no encontrado', 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Incident $incident)
    {
        try {
            // Verifica si el incidente existe
            $incident = Incident::find($incident);
            if ($incident == null) {
                return response()->json([
                    'message' => 'No se encuentra el incidente',
                    'code' => 404
                ], 404);
            }
            $incident->update($request->all());
            return response()->json([
                'data' => $incident,
                'code' => 200
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al actualizar el incidente',
                'code' => 500
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $incident = Incident::find($id);
        if ($incident == null) {
            return response()->json([
                'message' => 'No se encuentra el incidente',
                'code' => 404
            ], 404);
        }
        $incident->delete();
        return response()->json([
            'message' => 'Se ha eliminado el incidente',
            'code' => 200
        ], 200);
    }
}
