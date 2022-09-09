<?php

namespace App\Http\Controllers;

use App\Exceptions\InvariantException;
use App\Http\Requests\SkripsiAddRequest;
use App\Services\Impl\SkripsiServiceImpl;
use App\Services\SkripsiService;
use Illuminate\Support\Facades\Http;

class SkripsiController extends Controller
{
    //
    private SkripsiService $skripsiService;

    public function __construct() {
        $this->skripsiService = new SkripsiServiceImpl();
    }

    public function create($nim)
    {
        $url = 'https://feb-unsiq.ac.id/api/mahasiswa/';
        
        $response = Http::get($url . $nim);

        try {
            $mahasiswa = json_decode($response->body(), $depth=512, JSON_THROW_ON_ERROR)['data'];
            
            if ($response->status() == 200) {
                return view('skripsi.create', compact('mahasiswa'));
            }else {
                throw new InvariantException("Gagal menemukan data mahasiswa");
            }
        } catch (\Exception $e) {
            throw new InvariantException($e->getMessage());
        }   
    }

    public function store(SkripsiAddRequest $request)
    {
        try {
            $fileSkripsi = $request->file('file_skripsi');
            $tahunAjaranId = $request->input('tahun_ajaran_id');


            $skripsi = $this->skripsiService->add($request, $tahunAjaranId);
            $this->skripsiService->addFileSkripsi($skripsi->id, $fileSkripsi);

            return redirect('/')->with("success", "Berhasil Mendaftar Ujian Skripsi");
        } catch (InvariantException $e) {
            // return $e->getMessage();
            return redirect()->back()->with("error", $e->getMessage());
        }
    }
}
