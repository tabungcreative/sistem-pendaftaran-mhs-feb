<?php

namespace App\Services\Impl;

use App\Http\Requests\SkripsiAddRequest;
use App\Models\Skripsi;
use App\Services\SkripsiService;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;

class SkripsiServiceImpl implements SkripsiService
{
    public function add(SkripsiAddRequest $request, int $tahunAjaranId): Skripsi
    {
        // $nim = $request->input('nim');
        // $judul = $request->input('judul');
        // $pembimbing1 = $request->input('pembimbing1');
        // $pembimbing1 = $request->input('pembimbing2');

        // $url = 'http://localhost:3000';
        
        // $response = Http::get($url .'/mahasiswa');

        // try {
        //     $mahasiswa = json_decode($response->body(), $depth=512, JSON_THROW_ON_ERROR);
        // } catch (\Exception $e) {
        //     // handle exception
        //     echo "error";
        // }   

        
        // dd(isset($mahasiswa['data']));
        

    }
}