<?php

namespace App\Services;

use App\Jobs\GuardarPrestamoJob;
use App\Repositories\PrestamoRepository;
use Illuminate\Support\Str;

use Exception;

class PrestamoService
{
    protected PrestamoRepository $repositorio;

    public function __construct(PrestamoRepository $repositorio)
    {
        $this->repositorio = $repositorio;
    }

    // Calculo de fecha de devolucion
    private function calcularFechaDevolucion(int $dias): string
    {
        $fecha = now();
        while ($dias > 0) {
            $fecha->addDay();
            if (!$fecha->isWeekend()) {
                $dias--;
            }
        }
        return $fecha->toDateString();
    }


    // Reglas para la creacion de prestamo

    public function crearPrestamo(array $data): array
    {
        // Validaciones de negocio
        if ($data['tipoUsuario'] == 3 && $this->repositorio->usuarioTienePrestamo($data['identificacionUsuario'])) {
            throw new \Exception('El usuario ya tiene un libro prestado');
        }

        $dias = match ($data['tipoUsuario']) {
            1 => 10,
            2 => 8,
            3 => 7,
        };

        $id = (string) \Illuminate\Support\Str::uuid();

        $prestamo = [
            'id' => $id,
            'isbn' => $data['isbn'],
            'identificacionUsuario' => $data['identificacionUsuario'],
            'tipoUsuario' => $data['tipoUsuario'],
            'fechaMaximaDevolucion' => $this->calcularFechaDevolucion($dias),
        ];

        // Lanza el Job para guardar el préstamo
        \App\Jobs\GuardarPrestamoJob::dispatch($id, $prestamo);

        return [
            'id' => $id,
            'fechaMaximaDevolucion' => $prestamo['fechaMaximaDevolucion'],
        ];
    }


    // Busqueda del prestamo a traves del ID
    public function obtenerPrestamo(string $id): ?array
    {
        return $this->repositorio->buscar($id);
    }

    // Listado de todos los prestamos 
    public function listarPrestamos(): array
    {
        return $this->repositorio->todos();
    }

    // Finalizacion del prestamo
    public function finalizarPrestamo(string $id): bool
    {
        if (!$this->repositorio->buscar($id)) {
            return false;
        }

        $this->repositorio->eliminar($id);
        return true;
    }

}
