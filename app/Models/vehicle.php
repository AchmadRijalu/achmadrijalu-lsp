<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vehicle extends Model
{
    use HasFactory;
    
    protected $table = 'vehicles';

    protected $fillable = [
        'model',
        'year',
        'passenger_count',
        'manufacture',
        'price',
        'photo',
        
        
    ];
    protected $primaryKey = "id";

    

    public function vehicleable()
    {
        return $this->morphTo();
    }

    // public function cars()
    // {
    //     return $this->hasOne(car::class);
    // }
    // public function motorcycles()
    // {
    //     return $this->hasOne(motorcycle::class);
    // }
    // public function trucks()
    // {
    //     return $this->hasOne(truck::class);
    // }

}
