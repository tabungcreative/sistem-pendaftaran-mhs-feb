<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skripsi extends Model
{
    use HasFactory;
    protected $table = 'skripsi';
    protected $fillable = [
        'nim', 'tahun_ajaran_id', 'judul', 'pembimbing1', 'pembimbing2', 'file_skripsi', 'no_pembayaran'
    ];

    public function tahunAjaran() {
        return $this->belongsTo(TahunAjaran::class);
    }
}
