<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ordervehicle extends Model
{
    use HasFactory;


    protected $table = "order_vehicles";
    protected $primaryKey = "id";
    
}
