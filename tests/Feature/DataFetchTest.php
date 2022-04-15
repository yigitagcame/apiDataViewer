<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use App\Services\RequestService;

class DataFetchTest extends TestCase
{
    /** @test */
    public function aLegitGetRequestCanBeSentSuccessfully()
    {
        $http = new RequestService();
        $response = $http->get('https://trial.craig.mtcserver15.com/api/properties',[
            'page[number]' => 1,
            'page[size]' => 1,
        ]);

        $this->assertNotEquals(false, $response);

        $jsonResponse = json_decode($response, true);

        $expectedJsonKeys = [
            'current_page',
            'data',
            'first_page_url',
            'from',
            'last_page',
            'last_page_url',
            'next_page_url',
            'path',
            'per_page',
            'prev_page_url',
            'to',
            'total'
        ];

        $this->assertEquals($expectedJsonKeys,array_keys($jsonResponse));
    }


}