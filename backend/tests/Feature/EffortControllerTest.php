<?php

namespace Tests\Feature;

use App\User;
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

    public function testGuestCreate() {
    	$responce = $this->get(route('efforts.create'));

    	$responce->assertRedirect(route('login'));
    }

    public function testAuthCreate() {
    	$user = factory(User::class)->create();

    	$responce = $this->actingAs($user)
    		->get(route('efforts.create'));

    	$responce->assertRedirect(route('mypage.show', ['id' => $user->id]));
    }
}
