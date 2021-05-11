<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EffortControllerTest extends TestCase
{
    use RefreshDatabase;

    # 軌跡一覧表示機能のテスト
    public function testIndex(){
    	$responce = $this->get(route('home'));

    	$responce->assertStatus(200)
        ->assertViewIs('home');
    }

    # 軌跡作成画面　表示機能のテスト
    // 未ログイン時
    public function testGuestCreate() {
    	$responce = $this->get(route('efforts.create'));

    	$responce->assertRedirect(route('login'));
    }

    // ログイン時
    public function testAuthCreate() {
    	$user = factory(User::class)->create();

    	$responce = $this->actingAs($user)
    		->get(route('efforts.create'));

    	$responce->assertRedirect(route('mypage.show', ['id' => $user->id]));
    }

    
}
