<?php

namespace App\Jobs;
use App\Repositories\PrestamoRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class GuardarPrestamoJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected string $id;
    protected array $prestamo;

    public function __construct(string $id, array $prestamo)
    {
        $this->id = $id;
        $this->prestamo = $prestamo;
    }

    public function handle(PrestamoRepository $repositorio)
    {
        $repositorio->guardar($this->id, $this->prestamo);
    }
}
