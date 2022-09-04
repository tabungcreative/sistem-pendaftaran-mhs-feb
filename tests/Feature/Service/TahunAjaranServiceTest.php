<?php

namespace Tests\Feature\Service;

use App\Http\Requests\TahunAjaranAddRequest;
use App\Http\Requests\TahunAjaranUpdateRequest;
use App\Models\TahunAjaran;
use App\Services\TahunAjaranService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TahunAjaranServiceTest extends TestCase
{

    use RefreshDatabase;

    private TahunAjaranService $tahunAjaranService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->tahunAjaranService = $this->app->make(TahunAjaranService::class);
    }

    public function test_provider()
    {
        $this->assertTrue(true);
    }

    public function test_add_tahun_ajaran()
    {
        // assertions
        $request = new TahunAjaranAddRequest([
            'tahun' => "2020",
            'semester' => 1
        ]);

        $this->tahunAjaranService->add($request);
    
        $this->assertDatabaseCount('tahun_ajaran', 1);
        $this->assertDatabaseHas('tahun_ajaran', [
            'tahun' => '2020/2021',
            'semester' => 1
        ]);
    }

    /** @test */
    public function test_update_tahun_ajaran()
    {
        $tahunAjaran = TahunAjaran::factory()->create([
            'tahun' => '2020/2021',
            'semester' => 1
        ]);

        $request = new TahunAjaranUpdateRequest([
            'tahun' => 2022,
            'semester' => 2,
        ]);

        $this->tahunAjaranService->update($request, $tahunAjaran->id);

        $this->assertDatabaseCount('tahun_ajaran', 1);
        $this->assertDatabaseHas('tahun_ajaran', [
            'tahun' => '2022/2023',
            'semester' => 2
        ]);
    }

    /** @test */
    public function test_delete()
    {
        $tahunAjaran = TahunAjaran::factory()->create();
        $this->assertDatabaseCount('tahun_ajaran', 1);
        $this->tahunAjaranService->delete($tahunAjaran->id);
        $this->assertDatabaseCount('tahun_ajaran', 0);
    }
    
    
    
}
