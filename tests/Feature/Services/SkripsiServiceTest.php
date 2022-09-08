<?php

namespace Tests\Feature\Services;

use App\Exceptions\InvariantException;
use App\Http\Requests\SkripsiAddRequest;
use App\Models\TahunAjaran;
use App\Services\SkripsiService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SkripsiServiceTest extends TestCase
{
    use RefreshDatabase;

    private SkripsiService $skripsiService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->skripsiService = $this->app->make(SkripsiService::class);
    }

    public function test_provider()
    {
        $this->assertTrue(true);
    }

    /** @test */
    public function test_add_skripsi()
    {
        $request = new SkripsiAddRequest([
            'nim' => '78f5d0b3-4a95-3459-afed-987b8e5a4fbc',
            'judul' => 'test',
            'pembimbing1' => 'test',
            'pembimbing2' => 'test',
        ]);
        $tahunAjaran = TahunAjaran::factory()->create();
        $this->skripsiService->add($request, $tahunAjaran->id);

        $this->assertDatabaseCount('skripsi', 1);
        $this->assertDatabaseHas('skripsi', [
            'judul' => 'test'
        ]);
        $this->assertDatabaseCount('tahun_ajaran', 1);
    }

    /** @test */
    public function test_add_mahasiswa_nim_not_found()
    {
        $this->expectException(InvariantException::class);;
        $request = new SkripsiAddRequest([
            'nim' => 'salah',
            'judul' => 'test',
            'pembimbing1' => 'test',
            'pembimbing2' => 'test',
        ]);
        $tahunAjaran = TahunAjaran::factory()->create();
        $this->skripsiService->add($request, $tahunAjaran->id);
    }
    
    
}
