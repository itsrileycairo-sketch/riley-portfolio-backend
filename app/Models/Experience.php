<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    use HasFactory;

    protected $fillable = ['role', 'company', 'date', 'type', 'description', 'tech'];

    // Otomatis ubah JSON dari database ke bentuk Array di PHP
    protected $casts = [
        'description' => 'array',
        'tech' => 'array',
    ];
}