<?php

namespace Tests\Unit;

use App\Http\Controllers\Api\AdController;
use Tests\TestCase;
use Illuminate\Http\Request;

class AdControllerTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->controller = new AdController();
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */

    public function testCreateAd()
    {
        $request = Request::create('/api/ad', 'POST', [
            'title' => 'test',
            'desc' => 'test',
            'price' => 100,
            'photos' => [
                [
                    'url' => 'test',
                    'is_preview' => 1,
                ]
            ]
        ]);

        $response = $this->controller->create($request);
        $this->assertEquals(201, $response->getStatusCode());
    }
}
