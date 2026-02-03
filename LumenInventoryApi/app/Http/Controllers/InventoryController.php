<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function index()
    {
        return response()->json(['data' => Inventory::all()]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'book_id' => 'required|integer|unique:inventories',
            'quantity' => 'required|integer|min:0',
        ]);

        $inventory = Inventory::create([
            'book_id' => $request->book_id,
            'quantity' => $request->quantity,
            'reserved_quantity' => 0,
            'available_quantity' => $request->quantity,
        ]);

        return response()->json(['data' => $inventory], 201);
    }

    // --- MÉTODOS DE RESERVA Y STOCK ---

    public function reserve(Request $request) {
        $this->validate($request, [
            'book_id' => 'required|integer',
            'quantity' => 'required|integer|min:1'
        ]);

        $inventory = Inventory::where('book_id', $request->book_id)->firstOrFail();

        if ($inventory->available_quantity < $request->quantity) {
            return response()->json(['error' => 'Stock insuficiente'], 409);
        }

        $inventory->reserved_quantity += $request->quantity;
        $inventory->available_quantity -= $request->quantity;
        $inventory->save();

        return response()->json(['data' => $inventory]);
    }

    public function release(Request $request) {
        $this->validate($request, [
            'book_id' => 'required|integer',
            'quantity' => 'required|integer|min:1'
        ]);

        $inventory = Inventory::where('book_id', $request->book_id)->firstOrFail();

        // Evitar que la reserva baje de cero
        $amountToRelease = min($request->quantity, $inventory->reserved_quantity);

        $inventory->reserved_quantity -= $amountToRelease;
        $inventory->available_quantity += $amountToRelease;
        $inventory->save();

        return response()->json(['data' => $inventory]);
    }

    public function update(Request $request, $id) {
        $this->validate($request, [
            'quantity' => 'required|integer|min:0'
        ]);

        $inventory = Inventory::findOrFail($id);
        $inventory->quantity = $request->quantity;
        // Recalcular disponibilidad basada en la nueva cantidad total
        $inventory->available_quantity = $inventory->quantity - $inventory->reserved_quantity;
        $inventory->save();

        return response()->json(['data' => $inventory]);
    }

    public function showByBook($book_id){
    $inventory = \App\Models\Inventory::where('book_id', $book_id)->firstOrFail();
    return response()->json(['data' => $inventory]);
    }
}