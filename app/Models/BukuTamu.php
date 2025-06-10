<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BukuTamu extends Model {
    use HasFactory;

    protected $table = 'buku_tamu';
    protected $fillable = ['tanggal', 'waktu', 'foto', 'nama', 'instansi', 'telepon', 'tujuan', 'ttd'];

    protected $casts = [
        'tanggal' => 'date',
        'waktu' => 'datetime:H:i:s',
    ];
}




