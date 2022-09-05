<?php

namespace Tests\Feature\Services;

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
            'nim' => '2019150080',
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
    
}
