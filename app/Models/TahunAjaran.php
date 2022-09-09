<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TahunAjaran extends Model
{
    use HasFactory;
    protected $table = 'tahun_ajaran';
    protected $filleble = [
        'tahun', 'semester', 'is_active'
    ];

    public function skripsi() {
        return $this->hasMany(Skripsi::class);
    }
}
