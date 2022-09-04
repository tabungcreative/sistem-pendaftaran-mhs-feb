<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skripsi extends Model
{
    use HasFactory;
    protected $table = 'skripsi';
    protected $fillable = [
        'nim', 'tahun_ajaran_id', 'judul', 'pembimbing1', 'pembimbing2', 'file_berkas', 'file_ijazah', 'file_transkrip', 'file_akta', 'file_kk', 'file_kk', 'file_ktp', 'file_lembar_bimbingan', 'file_pembayaran_semester', 'file_pembayaran_skripsi',
        'file_sertifikat',
    ];
}
