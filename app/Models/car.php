<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class car extends Model
{
    use HasFactory;

    protected $table = 'cars';
    protected $fillable = [
        'fuel_type',
        'trunk_area',
        
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
