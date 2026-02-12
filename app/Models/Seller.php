<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'name',
        'address',
        'phone',
        'email',
        'store',
    ];

    // Relasi: Seller punya banyak Products
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
