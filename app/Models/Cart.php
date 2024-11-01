<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'user_id', 'product_id', 'quantity']; // Pastikan Anda mencantumkan kolom yang diisi

    public function product()
    {
        return $this->belongsTo(Product::class); // Menghubungkan ke model Product
    }
}
