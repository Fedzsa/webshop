<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class ProductControllerTest extends TestCase
{
    
    public function test_get_products_view() {
        $user = new User([
            'firstname' => 'Test',
            'lastname' => 'Man',
            'email' => 'testman@example.com',
            'password' => '12345678',
            'admin' => 1
        ]);

        $response = $this->actingAs($user)
                            ->get('/products');

        $response->assertStatus(200);
        $response->assertViewIs('product.index');
    }

    public function test_admin_can_reach_products_view() {
        $user = new User([
            'firstname' => 'Test',
            'lastname' => 'Man',
            'email' => 'testman@example.com',
            'password' => '12345678',
            'admin' => 1
        ]);

        $response = $this->actingAs($user)
                            ->get('/products');

        $response->assertStatus(200);
        $response->assertViewIs('product.index');
    }

    public function test_user_cant_reach_products_view() {
        $user = new User([
            'firstname' => 'Test',
            'lastname' => 'Man',
            'email' => 'testman@example.com',
            'password' => '12345678',
            'admin' => 0
        ]);

        $response = $this->actingAs($user)
                            ->get('/products');
        
        $response->assertStatus(403);
    }
}
