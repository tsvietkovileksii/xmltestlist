<?php

namespace App\Services;

use App\Contracts\ApiServiceInterface;
use GuzzleHttp\Client;

/**
 *
 */
class BoredApiService extends BaseApiService implements ApiServiceInterface
{
    /**
     * @var Client
     */
    protected $client;

    /**
     *
     */
    const ENDPOINT = 'https://www.boredapi.com/api/activity';

    /**
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @param array $data
     * @return array
     */
    public function extractData(array $data): array
    {
        if (empty($data['name']['first']) || empty($data['name']['last']) || empty($data['phone']) ||
            empty($data['email']) || empty($data['country'])) {
            throw new \Exception('Invalid API responses.');
        }

        return $data;
    }
}
