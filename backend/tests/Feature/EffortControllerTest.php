<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EffortControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testIndex(){
    	$responce = $this->get(route('home'));

    	$responce->assertStatus(200)
        ->assertViewIs('home');
    }
}
