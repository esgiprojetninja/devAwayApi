<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;

class PictureTest extends TestCase
{

    use RefreshDatabase;

    public function testLogin()
    {
        $this->post('/api/login', ["email" => "lambot.rom@gmail.com", "password" => "Rootroot9"])
             ->assertStatus(200);
    }

    /**
     * Test if insert picture is working.
     *
     * @return void
     */
    public function testPictureInsertSuccess()
    {

        $this->withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' .'',
            ])->post("/api/v1/pictures", ['url' => 'testingUrl'])
             ->assertStatus(201);
    }

    /**
     * Test if insert picture is working well on error.
     *
     * @return void
     */
    public function testPictureInsertError()
    {
        $this->post("/api/v1/pictures", ['url' => ''])
             ->assertStatus(500);
    }

    /**
     * Test if retrieving all pictures is working.
     *
     * @return void
     */
    public function testPictureGetAllSuccess()
    {
        factory(\App\Picture::class, 2)->create();

        $response = $this->json('GET', '/api/v1/pictures');

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                '*' => ['id', 'url', 'created_at', 'updated_at']
            ])
            ->assertJsonCount(2);
    }

    /**
     * Test if retrieving one picture by id is working.
     *
     * @return void
     */
    public function testPictureGetByIdSuccess()
    {
        factory(\App\Picture::class)->create();

        $response = $this->json('GET', '/api/v1/pictures/4');

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                'id',
                'url',
                'created_at',
                'updated_at'
            ]);
    }

    /**
     * Test if retrieving one picture by id is working well on error if not existing.
     *
     * @return void
     */
    public function testPictureGetByIdErrorNotFound()
    {
        $this->get("/api/v1/pictures/40")
            ->assertStatus(404);
    }

    /**
     * Test if delete picture is working well on success.
     *
     * @return void
     */
    public function testPictureDeleteSuccess()
    {
        factory(\App\Picture::class)->create();

        $this->delete("/api/v1/pictures/5")
            ->assertStatus(204);
    }

    /**
     * Test if delete picture is working well on error.
     *
     * @return void
     */
    public function testPictureDeleteError()
    {
        factory(\App\Picture::class)->create();

        $this->delete("/api/v1/pictures/7")
            ->assertStatus(404);
    }

    /**
     * Test if update picture is working well on success.
     *
     * @return void
     */
    public function testPictureUpdateSuccess()
    {
        factory(\App\Picture::class)->create();

        $this->put("/api/v1/pictures/7", ["url" => "myNewUrl"])
             ->assertStatus(200)
             ->assertJsonStructure([
                 'id',
                 'url',
                 'created_at',
                 'updated_at'
             ]);
    }

    /**
     * Test if update picture is working well on error.
     *
     * @return void
     */
    public function testPictureUpdateError()
    {
        factory(\App\Picture::class)->create();

        $this->put("/api/v1/pictures/9", ["url" => "myNewUrl"])
            ->assertStatus(404);
    }

}