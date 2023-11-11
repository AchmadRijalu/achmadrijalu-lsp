<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class motorcycle extends Model
{
    use HasFactory;

    protected $table = 'motorcycles';
    protected $fillable = [
        'petrol_capacity',
        'luggage_size',
        
        
    ];
    protected $primaryKey = "id";

    // public function vehicles()
    // {
    //     return $this->belongsTo(vehicle::class);
    // }

    public function vehicle(): MorphOne
    {
        return $this->morphOne(Vehicle::class, 'vehicleable');
    }
}
