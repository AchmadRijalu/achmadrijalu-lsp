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
    ];
    protected $primaryKey = "id";

    

    public function customers()
    {
        return $this->belongsTo(customer::class);
    }


    public function vehicles()
    {
        return $this->belongsToMany(vehicle::class, 'order_vehicles')->withPivot(['order_count']);
    }
}
