<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class truck extends Model
{
    use HasFactory;

    protected $table = 'trucks';
    protected $fillable = [
        'number_tires',
        'spacious_cargo_area',
        
        
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
