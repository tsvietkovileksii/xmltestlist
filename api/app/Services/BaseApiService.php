<?php

namespace App\Services;

/**
 *
 */
abstract class BaseApiService
{
    /**
     * @param array $data
     * @return array
     */
    abstract function extractData(array $data): array;

    /**
     * @return array
     */
    public function getData()
    {
        $response = $this->client->get(static::ENDPOINT);
        $body = $response->getBody();
        $data = json_decode($body, true);

        return $this->extractData($data);
    }

}
