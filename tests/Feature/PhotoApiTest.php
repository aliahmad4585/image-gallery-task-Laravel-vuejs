<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Http\Response;

class PhotoApiTest extends TestCase
{
    /**
     * Photo API with correct values.
     * @runInSeparateProcess
     *
     * @return void
     */
    public function testPhotoApiWithWeekdays()
    {
        $response = $this->json('GET',  '/photo', ['page' => 1, "weekday" => 1]);;
        $response->assertStatus(200);
    }

    /**
     * Photo API with only page number.
     * @runInSeparateProcess
     *
     * @return void
     */
    public function testPhotoApiWithPageNumberOnly()
    {
        $response = $this->json('GET',  '/photo', ['page' => 1]);
        $response->assertStatus(200);
    }

    /**
     * Photo API without param.
     * @runInSeparateProcess
     *
     * @return void
     */
    public function testPhotoApiWithoutparam()
    {
        $response = $this->json('GET',  '/photo', []);
        $response->assertStatus(200);
    }


}
