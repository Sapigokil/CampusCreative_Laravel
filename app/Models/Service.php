<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $table = 'services';

    protected $fillable = [
        'thumbnail',
        'title',
        'features', // Menyimpan daftar ceklist (dipisah baris baru)
        'price', // Harga tampil (Harga Diskon/Asli)
        'price_strike', // Harga coret (Harga Sebelum Diskon) - Opsional
        'button_url',
        'order_position',
        'is_active'
    ];
}