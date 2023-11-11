<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class customer extends Model
{
    use HasFactory;

    protected $table = 'customers';
    protected $fillable = [
        'name',
        'address',
        'phone_number',
        'id_card',
        
    ];
    protected $primaryKey = "id";


    public function orders()
    {
        return $this->hasMany(order::class);
    }
}
