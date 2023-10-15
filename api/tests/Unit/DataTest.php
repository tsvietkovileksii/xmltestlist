<?php

namespace Tests\Unit;

use App\Repositories\UserListRepository;
use App\Services\ApiSwitchService;
use App\Services\BoredApiService;
use App\Services\RandomUserApiService;
use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;
use SimpleXMLElement;

class DataTest extends TestCase
{
    public function testExtractDataValidInput()
    {
        $httpClientMock = $this->createMock(Client::class);
        $apiServiceMock = new BoredApiService($httpClientMock);

        $data = [
            'name' => [
                'first' => 'John',
                'last' => 'Doe',
            ],
            'phone' => '1234567890',
            'email' => 'john.doe@example.com',
            'country' => 'US',
        ];

        $result = $apiServiceMock->extractData($data);

        $this->assertEquals($data, $result);
    }

    public function testExtractDataInvalidInput()
    {
        $httpClientMock = $this->createMock(Client::class);
        $apiServiceMock = new BoredApiService($httpClientMock);

        $invalidData = [
            'name' => [
                'first' => 'John',
                'last' => 'Doe',
            ],
            'phone' => '',
            'email' => 'john.doe@example.com',
            'country' => 'US',
        ];

        $this->expectException(\Exception::class);
        $apiServiceMock->extractData($invalidData);
    }


}
