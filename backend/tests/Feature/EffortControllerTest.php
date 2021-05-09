<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EffortControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testIndex(){
        $response = $this->get('/');
        $response->assertStatus(200);

    }
}
