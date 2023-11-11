<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    use HasFactory;

    protected $table = 'orders';
    protected $fillable = [
        'customer_id',
        'vehicle_id',
        'total_count',
    ];
    protected $primaryKey = "id";

    

    public function customer()
    {
        return $this->belongsTo(customer::class);
    }
    public function vehicle()
    {
        return $this->belongsTo(vehicle::class);
    }


    
}
