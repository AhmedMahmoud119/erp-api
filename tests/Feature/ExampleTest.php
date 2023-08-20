<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic test example.
     *
     * @return void
     */
    protected $tenancy = true;

    public function test_the_application_returns_a_successful_response()
    {
        $response = $this->get('/api/v1/journal-entries');

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'name',
                    'status',
                    'tenant_id',
                    'creator_id',
                    'created_at',
                    'updated_at',
                ]
            ]
        ]);

        dd($response->json());
        // $response->assertStatus(500);
    }
}
