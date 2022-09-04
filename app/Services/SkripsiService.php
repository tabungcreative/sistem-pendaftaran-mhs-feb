<?php

namespace App\Services;

use App\Http\Requests\SkripsiAddRequest;
use App\Models\Skripsi;

interface SkripsiService
{
    function add(SkripsiAddRequest $request, int $tahunAjaranId): Skripsi;
    // function addBerkas(int $id, $file): Skripsi;
    // function addIjazah(int $id, $file): Skripsi;
    // function addTanskrip(int $id, $file): Skripsi;
    // function addAkta(int $id, $file): Skripsi;
    // function addKK(int $id, $file): Skripsi;
    // function addKTP(int $id, $file): Skripsi;
    // function addLembarBimbingan(int $id, $file): Skripsi;
    // function addPembayaranSkripsi(int $id, $file): Skripsi;
    // function addSertifikat(int $id, $file): Skripsi;
} 
