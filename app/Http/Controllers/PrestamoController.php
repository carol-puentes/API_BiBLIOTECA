<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PrestamoService;
use Illuminate\Validation\ValidationException;
use Exception;

class PrestamoController extends Controller
{
    protected PrestamoService $prestamoService;

    public function __construct(PrestamoService $prestamoService)
    {
        $this->prestamoService = $prestamoService;
    }

    // Creacion del prestamo
    public function crear(Request $request)
    {
        try {
            $validated = $request->validate([
                'isbn' => 'required|string',
                'identificacionUsuario' => 'required|string|max:10',
                'tipoUsuario' => 'required|integer|in:1,2,3',
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'error' => $e->errors()
            ], 400); // devolvemos 400 en vez de 422
        }

        try {
            $prestamo = $this->prestamoService->crearPrestamo($validated);
            return response()->json($prestamo);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    // Obtenecion del prestamo a traves del ID
    public function mostrar(string $id)
    {
        $prestamo = $this->prestamoService->obtenerPrestamo($id);
        if (!$prestamo) {
            return response()->json(['error' => 'El préstamo no existe'], 404);
        }
        return response()->json($prestamo);
    }

    // Listado de todos los prestamos 
    public function listar()
    {
        return response()->json($this->prestamoService->listarPrestamos());
    }

    // Finalizacion del prestamo
    public function finalizar(string $id)
    {
        if (!$this->prestamoService->finalizarPrestamo($id)) {
            return response()->json(['error' => 'El préstamo no existe'], 404);
        }
        return response()->json(['mensaje' => 'Préstamo finalizado correctamente']);
    }
}
