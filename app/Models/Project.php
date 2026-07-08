<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    // Kolom yang diizinkan untuk diisi dari form
    protected $fillable = ['title', 'category', 'tech', 'description', 'link', 'image'];

    // Otomatis mengubah teks JSON dari database kembali menjadi Array di PHP
    protected $casts = [
        'tech' => 'array',
    ];
}