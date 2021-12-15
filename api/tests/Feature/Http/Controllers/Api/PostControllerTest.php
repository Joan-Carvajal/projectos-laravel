<?php

namespace Tests\Feature\Http\Controllers\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_store()
    {
        $response = $this->json('POST', '/api/posts',[
            'title' =>'El post'
        ]);

        $response->assertJsonStructure(['id', 'title', 'created_at', 'updated_up'])->assertJson([ 'title' =>'El post'])
        ->assertStatus(201);// Ok , CREADO UN RECURSO
        $this->assertDatabaseHas('posts', [ 'title' =>'El post'] );
    }
}
