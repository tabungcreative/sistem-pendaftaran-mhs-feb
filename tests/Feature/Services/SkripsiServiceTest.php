<?php

namespace Tests\Feature\Services;

use App\Exceptions\InvariantException;
use App\Helper\Media;
use App\Http\Requests\SkripsiAddRequest;
use App\Models\Skripsi;
use App\Models\TahunAjaran;
use App\Services\SkripsiService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class SkripsiServiceTest extends TestCase
{
    use RefreshDatabase, Media;

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
    public function test_add_skripsi_success()
    {
        $request = new SkripsiAddRequest([
            'nim' => '78f5d0b3-4a95-3459-afed-987b8e5a4fbc',
            'judul' => 'test',
            'pembimbing1' => 'test',
            'pembimbing2' => 'test',
        ]);
        $tahunAjaran = TahunAjaran::factory()->create(['is_active' => 1]);
        $this->skripsiService->add($request);

        $this->assertDatabaseCount('skripsi', 1);
        $this->assertDatabaseHas('skripsi', [
            'judul' => 'test'
        ]);
        $this->assertDatabaseCount('tahun_ajaran', 1);
    }

    public function test_add_skripsi_fail()
    {
        $this->expectException(InvariantException::class);

        $request = new SkripsiAddRequest([
            'nim' => '78f5d0b3-4a95-3459-afed-987b8e5a4fbc',
            'judul' => 'test',
            'pembimbing1' => 'test',
            'pembimbing2' => 'test',
        ]);
        $tahunAjaran = TahunAjaran::factory()->create(['is_active' => 0]);
        $this->skripsiService->add($request);
    }
    /** @test */
    public function test_add_mahasiswa_nim_not_found()
    {
        $this->expectException(InvariantException::class);
        $request = new SkripsiAddRequest([
            'nim' => 'salah',
            'judul' => 'test',
            'pembimbing1' => 'test',
            'pembimbing2' => 'test',
        ]);
        $tahunAjaran = TahunAjaran::factory()->create();
        $this->skripsiService->add($request, $tahunAjaran->id);
    }
    
    /** @test */
    public function test_tambah_file_skripsi()
    {
        $skripsi = Skripsi::factory()->create();

        $file = UploadedFile::fake()->create('file.png');

        $result = $this->skripsiService->addFileSkripsi($skripsi->id, $file);

        $this->assertDatabaseCount('skripsi', 1);
        $this->assertDatabaseHas('skripsi', [
            'file_skripsi' => $result->file_skripsi,
        ]);

        self::assertFileExists(storage_path('/app/public/' . $result->file_skripsi));

        @unlink(storage_path('/app/public/'.$result->file_skripsi));
    }
    
    public function test_delete_file_skripsi()
    {

        $file = UploadedFile::fake()->create('file.jpg');
        $uploads = $this->uploads($file, 'test/');
        $skripsi = Skripsi::factory()->create([
            'file_skripsi' => $uploads['filePath'],
        ]);

        self::assertFileExists(storage_path('/app/public/' . $skripsi->file_skripsi));
        $this->assertDatabaseCount('skripsi', 1);

        $this->skripsiService->deleteFileSkripsi($skripsi->id);

        $this->assertDatabaseCount('skripsi', 1);
        self::assertFileDoesNotExist($skripsi->file_skripsi);


    }

    public function test_tambah_file_slip_bayar()
    {
        $skripsi = Skripsi::factory()->create();

        $file = UploadedFile::fake()->create('file.png');

        $result = $this->skripsiService->addFileSlipBayar($skripsi->id, $file);

        $this->assertDatabaseCount('skripsi', 1);
        $this->assertDatabaseHas('skripsi', [
            'file_slip_bayar' => $result->file_slip_bayar,
        ]);

        self::assertFileExists(storage_path('/app/public/' . $result->file_slip_bayar));

        @unlink(storage_path('/app/public/'.$result->slip_file_slip_bayarbayar));
    }
    
    public function test_delete_file_slip_bayar()
    {

        $file = UploadedFile::fake()->create('file.jpg');
        $uploads = $this->uploads($file, 'test/');
        $skripsi = Skripsi::factory()->create([
            'file_slip_bayar' => $uploads['filePath'],
        ]);

        self::assertFileExists(storage_path('/app/public/' . $skripsi->file_slip_bayar));
        $this->assertDatabaseCount('skripsi', 1);

        $this->skripsiService->deleteFileSlipBayar($skripsi->id);

        $this->assertDatabaseCount('skripsi', 1);
        self::assertFileDoesNotExist($skripsi->file_slip_bayar);

    }
}
