<?php

namespace App\Services\Impl;

use App\Exceptions\InvariantException;
use App\Helper\Media;
use App\Http\Requests\SkripsiAddRequest;
use App\Models\Skripsi;
use App\Models\TahunAjaran;
use App\Services\SkripsiService;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;

class SkripsiServiceImpl implements SkripsiService
{

    use Media;

    public function add(SkripsiAddRequest $request): Skripsi
    {
        $tahunAjaran = TahunAjaran::where('is_active', 1)->first();

        if ($tahunAjaran == null) {
            throw new InvariantException("Tahun Ajaran belum belum ditentukan");
        }

        $nim = $request->input('nim');
        $judul = $request->input('judul');
        $noPembayaran = $request->input('no_pembayaran');
        $pembimbing1 = $request->input('pembimbing1');
        $pembimbing2 = $request->input('pembimbing2');

        $apiMahasiswa = 'https://feb-unsiq.ac.id/api/mahasiswa/';
        $apiPembayaran = 'http://127.0.0.1:8000/api/pembayaran/';
        
        
        try {
            $responseMahasiswa = Http::get($apiMahasiswa . $nim);
            $mahasiswa = json_decode($responseMahasiswa->body(), $depth=512, JSON_THROW_ON_ERROR)['data'];
            $responsePembayaran = Http::get($apiPembayaran . $noPembayaran);
            $pembayaran = json_decode($responsePembayaran->body(), $depth=512, JSON_THROW_ON_ERROR)['data'];

            if ($responseMahasiswa->status() == 200 && $responsePembayaran->status() == 200 ) {
                if ($pembayaran['nim'] != $nim) {
                    throw new InvariantException("No pembayaran tidak sesuai");    
                }

                $skripsi = new Skripsi();
                $skripsi->nim = $mahasiswa['nim'];
                $skripsi->judul = $judul;
                $skripsi->pembimbing1 = $pembimbing1;
                $skripsi->pembimbing2 = $pembimbing2;
                $skripsi->no_pembayaran = $pembayaran['no_pembayaran'];
                $tahunAjaran->skripsi()->save($skripsi);
            }else {
                throw new InvariantException("Gagal menemukan data mahasiswa");
            }
        } catch (\Exception $e) {
            throw new InvariantException($e->getMessage());
        }   

        return $skripsi;
    }

    public function addFileSkripsi(int $id, $file): Skripsi
    {
        $skripsi = Skripsi::find($id);

        try {
            if ($skripsi->file_skripsi != null) {
                unlink(storage_path('/app/public/'.$skripsi->file_skripsi));
            }

            $dataFile = $this->uploads($file, 'skripsi/file-skripsi/');
            $fileSkripsi = $dataFile['filePath'];

            $skripsi->file_skripsi = $fileSkripsi;
            $skripsi->save();

        }catch (\Exception $exception) {
            throw new InvariantException($exception->getMessage());
        }

        return $skripsi;
    }

    public function deleteFileSkripsi(int $id): Skripsi
    {
        $skripsi = Skripsi::find($id);

        try {
            if ($skripsi->file_skripsi != null) {
                unlink(storage_path('/app/public/'.$skripsi->file_skripsi));
            }

            $skripsi->file_skripsi = null;
            $skripsi->save();

        }catch (\Exception $exception) {
            throw new InvariantException($exception->getMessage());
        }

        return $skripsi;
    }

}   