<?php

namespace App\Services;

use App\Http\Requests\TahunAjaranAddRequest;
use App\Http\Requests\TahunAjaranUpdateRequest;
use App\Models\TahunAjaran;

interface TahunAjaranService
{
    function add(TahunAjaranAddRequest $request): TahunAjaran;
    function update(TahunAjaranUpdateRequest $request, int $id): TahunAjaran;
    function delete(int $id): void;
}
