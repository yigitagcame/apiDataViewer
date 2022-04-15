<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use App\Services\RequestService;

class HttpServiceTest extends TestCase
{
    /** @test */
    public function aLegitGetRequestCanBeSentSuccessfully()
    {
        $http = new RequestService();
        $response = $http->get('https://google.com');

        $this->assertNotEquals(false, $response);
    }

    /** @test */
    public function aNonlegitGetRequestCanNotBeSentSuccessfully()
    {
        $http = new RequestService();
        $response = $http->get('https://google');

        $this->assertEquals(false, $response);
    }
}