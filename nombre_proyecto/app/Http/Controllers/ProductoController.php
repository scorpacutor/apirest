<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Importa la clase DB


class ProductoController extends Controller
{
    public function index()
    {
 
        $productos = DB::table('Animales')->get();

       
        return response()->json($productos);
    }

    
    public function crear(Request $request)
    {
    
    
        // Crea un nuevo registro en la tabla "Animales"
        $nuevoAnimal = DB::table('Animales')->insert([
            'nombre' => $request->input('nombre'),
            'edad' => $request->input('edad'),
            'raza' => $request->input('raza'),
        ]);
    
        if ($nuevoAnimal) {
            return response()->json(['message' => 'Animal creado con éxito'], 201);
        } else {
            return response()->json(['error' => 'Error al crear el animal'], 500);
        }
    }
    
    public function eliminar($id)
    {
        
        $eliminado = DB::table('Animales')->where('id', $id)->delete();
    
        if ($eliminado) {
            return response()->json(['message' => 'Animal eliminado con éxito'], 200);
        } else {
            return response()->json(['error' => 'No se pudo eliminar el animal'], 500);
        }
    }

    public function actualizar(Request $request, $id)
{


    // Actualiza el registro en la base de datos
    $actualizado = DB::table('Animales')
        ->where('id', $id)
        ->update([
            'nombre' => $request->input('nombre'),
            'edad' => $request->input('edad'),
            'raza' => $request->input('raza'),
        ]);

    if ($actualizado) {
        return response()->json(['message' => 'Animal actualizado con éxito'], 200);
    } else {
        return response()->json(['error' => 'No se pudo actualizar el animal'], 500);
    }
}

}


