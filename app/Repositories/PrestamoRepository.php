<?php
namespace App\Repositories;

class PrestamoRepository{
    public static array $data=[];

    public function __construct()
    {
        // Si no hay datos en memoria, intentar cargar desde archivo JSON
        if (empty(self::$data)) {
            $this->cargarDesdeArchivo();
        }
    }


    //Guardado de prestamo en bd de memoria 
    public function guardar(string $id, array $prestamo): void
    {
        self::$data[$id] = $prestamo;
        $this->guardarEnArchivo();
    }

    //Busqueda de prestamo 
    public function buscar(string $id): ?array
    {
        return self::$data[$id] ?? null;
    }

    //Lista de prestamos 
    public function todos(): array
    {
        if (empty(self::$data)) {
            $this->cargarDesdeArchivo();
        }
        
        return self::$data;
    }

    //Eliminacion de prestamo
    public function eliminar(string $id): void
    {
        unset(self::$data[$id]);
        $this->guardarEnArchivo();
    }

    //Validacion para realizar prestamo
    public function usuarioTienePrestamo(string $identificacionUsuario): bool
    {
        foreach (self::$data as $prestamo) {
            if ($prestamo['identificacionUsuario'] === $identificacionUsuario) {
                return true;
            }
        }
        return false;
    }


     private function rutaArchivo(): string
    {
        return storage_path('app/prestamos.json');
    }

    private function cargarDesdeArchivo(): void
    {
        $ruta = $this->rutaArchivo();

        if (!file_exists($ruta)) {
            // Crear archivo vacío si no existe
            file_put_contents($ruta, json_encode([]));
        }

        $contenido = file_get_contents($ruta);
        $data = json_decode($contenido, true);

        if (is_array($data)) {
            self::$data = $data;
        }
    }

    private function guardarEnArchivo(): void
    {
        $ruta = $this->rutaArchivo();
        file_put_contents($ruta, json_encode(self::$data, JSON_PRETTY_PRINT));
    }

}








