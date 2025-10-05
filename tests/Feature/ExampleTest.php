<?php

namespace Tests\Feature;

use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * Basic smoke test to ensure application is working
     */
    public function test_application_returns_successful_response()
    {
        $this->markTestSkipped('Skipping until database is properly seeded after upgrades');
        $response = $this->get('/');
        $response->assertStatus(200);
    }
}