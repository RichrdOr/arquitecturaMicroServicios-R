<?php

namespace App\Http\Controllers;

use App\Services\InventoryService;
use Illuminate\Http\Request;
use App\Traits\ApiResponser;
use Illuminate\Http\Response;

class InventoryController extends Controller
{
    use ApiResponser;

    /**
     * El servicio para consumir el microservicio de inventario
     * @var InventoryService
     */
    public $inventoryService;

    public function __construct(InventoryService $inventoryService)
    {
        $this->inventoryService = $inventoryService;
    }

    /**
     * Devuelve la lista de todo el inventario
     */
    public function index()
    {
        return $this->successResponse($this->inventoryService->obtainInventories());
    }

    /**
     * Crea un nuevo registro de inventario
     */
    public function store(Request $request)
    {
        return $this->successResponse($this->inventoryService->createInventory($request->all()), Response::HTTP_CREATED);
    }

    /**
     * Obtiene el stock de un libro específico
     */
    public function show($book_id)
    {
        return $this->successResponse($this->inventoryService->obtainInventoryByBook($book_id));
    }

    /**
     * Reserva unidades de un libro
     */
    public function reserve(Request $request)
    {
        return $this->successResponse($this->inventoryService->reserveInventory($request->all()));
    }
}