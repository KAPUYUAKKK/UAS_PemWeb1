<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'price', 'stock', 'image'];

    public function barangMasuk()
    {
        return $this->hasMany(BarangMasuk::class);
    }

    public function penjualan()
    {
        return $this->hasMany(Penjualan::class);
    }
}
