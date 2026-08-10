<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ulasan extends Model
{

    use HasFactory;

    protected $table = 'ulasan';
protected $fillable = ['destinasi_id', 'user_id', 'rating', 'komentar'];
 
public function destinasi() { return $this->belongsTo(Destinasi::class); }
public function user() { return $this->belongsTo(User::class); 
}

public function ulasan() { return $this->hasMany(Ulasan::class); }

}
