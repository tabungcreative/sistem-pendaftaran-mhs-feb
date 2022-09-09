<?php

namespace App\Services\Impl;

use App\Exceptions\InvariantException;
use App\Http\Requests\TahunAjaranAddRequest;
use App\Http\Requests\TahunAjaranUpdateRequest;
use App\Models\TahunAjaran;
use App\Services\TahunAjaranService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TahunAjaranServiceImpl implements TahunAjaranService 
{
    public function add(TahunAjaranAddRequest $request): TahunAjaran
    {
        $tahun = $request->input('tahun'). "/" .((int)$request->input('tahun')+1);
        $semester = $request->input('semester');
        $isActive = $request->input('isActive');

        try {
            $tahunAjaran = new TahunAjaran();
            $tahunAjaran->tahun = $tahun;
            $tahunAjaran->semester = $semester;
            if ($isActive) {
                $tahunAjaranActive = TahunAjaran::where('is_active', 1)->first();
                $tahunAjaranActive->is_active = 0;
                $tahunAjaranActive->save();
                
                $tahunAjaran->is_active = 1;
            }
            $tahunAjaran->save();
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            throw new InvariantException($e->getMessage());
        }
        
        return $tahunAjaran;
    }

    public function update(TahunAjaranUpdateRequest $request, int $id): TahunAjaran
    {
        $tahunAjaran = TahunAjaran::find($id);
        $tahun = $request->input('tahun'). "/" .((int)$request->input('tahun')+1);
        $semester = $request->input('semester');

        try {
            $tahunAjaran->tahun = $tahun;
            $tahunAjaran->semester = $semester;
            $tahunAjaran->save();
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            throw new InvariantException($e->getMessage());
        }

        return $tahunAjaran;
    }

    public function delete(int $id): void
    {
        $tahunAjaran = TahunAjaran::find($id);      

        try {
            $tahunAjaran->delete();
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            throw new InvariantException($e->getMessage());
        }
    }

    public function active(int $id): TahunAjaran
    {
        $tahunAjaran = TahunAjaran::find($id);      
        
        $tahunAjaranActive = TahunAjaran::where('is_active', 1)->first();

        try {
            DB::beginTransaction();
            
            $tahunAjaranActive->is_active = 0;
            $tahunAjaranActive->save();

            $tahunAjaran->is_active = 1;
            $tahunAjaran->save();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            throw new InvariantException($e->getMessage());
        }

        return $tahunAjaran;
    }
    
}