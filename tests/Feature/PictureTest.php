<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PictureTest extends TestCase
{

    use RefreshDatabase;

    /**
     * Test if insert picture is working.
     *
     * @return void
     */
    public function testPictureInsertSuccess()
    {
        $this->post("/api/v1/pictures", ['url' => 'testingUrl'])
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



}