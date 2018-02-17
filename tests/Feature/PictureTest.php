<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

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
        $response = $this->json('POST', '/api/v1/pictures', ['url' => 'testingUrl']);

        $response
            ->assertStatus(200)
            ->assertJson([
                'created' => true,
            ]);
    }

    /**
     * Test if insert picture is working well on error.
     *
     * @return void
     */
    public function testPictureInsertError()
    {
        $response = $this->json('POST', '/api/v1/pictures', ['notUrl' => 'foo']);

        $response
            ->assertStatus(500);
    }

    /**
     * Test if retrieving all pictures is working.
     *
     * @return void
     */
    public function testPictureGetAllSuccess()
    {
        $response = $this->json('GET', '/api/v1/pictures');

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                '*' => ['id', 'url',' created_at', 'updated_at']
            ]);
    }

    /**
     * Test if retrieving one picture by id is working.
     *
     * @return void
     */
    public function testPictureGetByIdSuccess()
    {
        $response = $this->json('GET', '/api/v1/pictures/1');

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                'id',
                'url',
                'created_at',
                'updated_at'
            ]);
    }

}