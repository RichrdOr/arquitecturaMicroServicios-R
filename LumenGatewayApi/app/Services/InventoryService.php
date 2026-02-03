<?php

namespace App\Services;

use App\Traits\ConsumesExternalService;

class InventoryService
{
    use ConsumesExternalService;

    /**
     * La URL base para consumir el servicio de inventario
     * @var string
     */
    public $baseUri;

    public function __construct()
    {
        // Esto lee la configuración que acabas de poner en config/services.php
        $this->baseUri = config('services.inventory.base_uri');
    }

    /**
     * Obtener la lista completa de inventario
     */
    public function obtainInventories()
    {
        return $this->performRequest('GET', '/inventory');
    }

    /**
     * Crear un nuevo registro de stock
     */
    public function createInventory($data)
    {
        return $this->performRequest('POST', '/inventory', $data);
    }

    /**
     * Obtener el stock de un libro específico
     */
    public function obtainInventoryByBook($book_id)
    {
        return $this->performRequest('GET', "/inventory/book/{$book_id}");
    }

    /**
     * Realizar una reserva de stock
     */
    public function reserveInventory($data)
    {
        return $this->performRequest('POST', '/inventory/reserve', $data);
    }
}