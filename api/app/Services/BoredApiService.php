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
        if (empty($data['name_first']) || empty($data['name_last']) || empty($data['phone']) ||
            empty($data['email']) || empty($data['country'])) {
            throw new \Exception('Invalid API responses.');
        }

        $result['fullName'] = implode(' ', [$data['name_first'], $data['name_last']]);
        $result['firstName'] = $data['name_first'];
        $result['lastName'] = $data['name_last'];
        $result['phone'] = $data['phone'];
        $result['email'] = $data['email'];
        $result['country'] = $data['location']['country'];

        return $result;
    }
}
