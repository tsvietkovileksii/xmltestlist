<?php

namespace App\Services;

use App\Contracts\ApiServiceInterface;
use GuzzleHttp\Client;

/**
 *
 */
class RandomUserApiService extends BaseApiService implements ApiServiceInterface
{
    /**
     * @var Client
     */
    protected $client;

    /**
     *
     */
    const ENDPOINT = 'https://randomuser.me/api/';

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
        $dataResult = $data['results'][0] ?? [];

        if (empty($dataResult['name']['first']) || empty($dataResult['name']['last']) || empty($dataResult['phone']) ||
            empty($dataResult['email']) || empty($dataResult['location']['country'])) {
            throw new \Exception('Invalid API responses.');
        }

        $result['fullName'] = implode(' ', $dataResult['name']);
        $result['firstName'] = $dataResult['name']['first'];
        $result['lastName'] = $dataResult['name']['last'];
        $result['phone'] = $dataResult['phone'];
        $result['email'] = $dataResult['email'];
        $result['country'] = $dataResult['location']['country'];

        return $result;
    }

}
