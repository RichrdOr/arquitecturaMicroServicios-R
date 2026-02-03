<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $fillable = [
        'book_id', 
        'quantity', 
        'reserved_quantity', 
        'available_quantity'
    ];
}