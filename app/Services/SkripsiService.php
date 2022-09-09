<?php

namespace App\Services;

use App\Http\Requests\SkripsiAddRequest;
use App\Models\Skripsi;

interface SkripsiService
{
    function add(SkripsiAddRequest $request): Skripsi;
    function addFileSkripsi(int $id, $file): Skripsi;
    function deleteFileSkripsi(int $id): Skripsi;
} 
