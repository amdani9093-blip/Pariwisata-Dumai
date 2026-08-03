<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destinasi extends Model
{
    use HasFactory;

    protected $table = 'destinasi';
protected $fillable = [
    'nama', 
    'deskripsi', 
    'gambar', 
    'jam_buka', 
    'jam_tutup', 
    'lokasi',
];


}
