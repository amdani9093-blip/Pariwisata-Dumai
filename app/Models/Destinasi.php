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
    'harga_tiket'
];

public function atraksi()
{
    return $this->hasMany(Atraksi::class);
}
public function ulasan() { return $this->hasMany(Ulasan::class);
 }

}
