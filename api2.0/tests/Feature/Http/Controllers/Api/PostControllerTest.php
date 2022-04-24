<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Http\Requests\Post as PostRequests;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Post;
use App\Models\User;

class PostControllerTest extends TestCase
{
    use RefreshDatabase;
    public function test_store()
    {
        $user=User::factory()->create();
        $this->withExceptionHandling();
        $response = $this->actingAs($user, 'sanctum')->json('POST','api/posts',[
            'title'=>'este es un titulo'
        ]);

        $response->assertJsonStructure(['id', 'title', 'created_at', 'updated_at'])
        ->assertJson(['title'=>'este es un titulo'])
        ->assertStatus(201);
        $this->assertDatabaseHas('posts', ['title'=>'este es un titulo']);
    }
    public function test_validate_title()
    {
        $user=User::factory()->create();
        $response = $this->actingAs($user, 'sanctum')->json('POST','api/posts',[
            'title'=>''
        ]);
        $response->assertStatus(422)
        ->assertJsonValidationErrors('title'); //fue imposible completarla
    }

    public function test_show()
    {
        $user=User::factory()->create();
        $post=Post::factory()->create();
        $response = $this->actingAs($user, 'sanctum')->json('GET',"api/posts/$post->id");

        $response->assertJsonStructure(['id', 'title', 'created_at', 'updated_at'])
        ->assertJson(['title'=>$post->title])
        ->assertStatus(200);//OK

    }
    public function test_404_show()
    {

        $user=User::factory()->create();
        $post=Post::factory()->create();
        $response = $this->actingAs($user, 'sanctum')->json('GET',"api/posts/1000");

        $response->assertStatus(404);//OK

    }
    public function test_update()
    {
        $user=User::factory()->create();

        $this->withExceptionHandling();
        $post=Post::factory()->create();

        $response = $this->actingAs($user, 'sanctum')->json('PUT',"api/posts/$post->id",[
            'title'=>'nuevo'
        ]);

        $response->assertJsonStructure(['id', 'title', 'created_at', 'updated_at'])
        ->assertJson(['title'=>'nuevo'])
        ->assertStatus(200);
        $this->assertDatabaseHas('posts', ['title'=>'nuevo']);
    }

    public function test_delete()
    {
        $this->withExceptionHandling();
        $user=User::factory()->create();
        $post=Post::factory()->create();

        $response = $this->actingAs($user,'sanctum')->json('DELETE',"api/posts/$post->id");

        $response->assertSee(null)
        ->assertStatus(204);//sin contenido
        $this->assertDatabaseMissing('posts', ['id'=>$post->id]);
    }
    public function test_index()
    {
        Post::factory()->count(5)->create();
        $user=User::factory()->create();
        $response= $this->actingAs($user, 'sanctum')->json('GET','/api/posts');
        $response->assertJsonStructure([
            'data' =>[
                '*'=>['id','title', 'created_at', 'updated_at']
            ]
        ])->assertStatus(200);//ok
    }

    public function test_guest(){
        $this->json('GET',  '/api/posts')->assertStatus(401);
        $this->json('POST',  '/api/posts')->assertStatus(401);
        $this->json('PUT',  '/api/posts/1000')->assertStatus(401);
        $this->json('PUT',  '/api/posts/1000')->assertStatus(401);
        $this->json('DELETE',  '/api/posts/1000')->assertStatus(401);




    }
}
