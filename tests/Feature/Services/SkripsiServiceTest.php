<?php

namespace Tests\Feature\Services;

use App\Http\Requests\SkripsiAddRequest;
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
        $this->skripsiService->add(new SkripsiAddRequest(), 1);
        $this->assertTrue(true);
    }
}
