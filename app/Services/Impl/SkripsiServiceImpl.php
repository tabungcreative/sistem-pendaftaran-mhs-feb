<?php

namespace App\Services\Impl;

use App\Exceptions\InvariantException;
use App\Http\Requests\SkripsiAddRequest;
use App\Models\Skripsi;
use App\Models\TahunAjaran;
use App\Services\SkripsiService;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;

class SkripsiServiceImpl implements SkripsiService
{
    public function add(SkripsiAddRequest $request, int $tahunAjaranId): Skripsi
    {
        $tahunAjaran = TahunAjaran::find($tahunAjaranId);
        $nim = $request->input('nim');
        $judul = $request->input('judul');
        $pembimbing1 = $request->input('pembimbing1');
        $pembimbing2 = $request->input('pembimbing2');

        $url = 'http://localhost:3000';
        
        $response = Http::get($url .'/mahasiswa');

        try {
            $mahasiswa = json_decode($response->body(), $depth=512, JSON_THROW_ON_ERROR)['data'];
         
            if (isset($mahasiswa)) {
                $skripsi = new Skripsi();
                $skripsi->nim = $mahasiswa['nim'];
                $skripsi->judul = $judul;
                $skripsi->pembimbing1 = $pembimbing1;
                $skripsi->pembimbing2 = $pembimbing2;
                $tahunAjaran->skripsi()->save($skripsi);
            }else {
                throw new InvariantException("Gagal menemukan data mahasiswa");
            }
        } catch (\Exception $e) {
            throw new InvariantException($e->getMessage());
        }   

        return $skripsi;
    }
}