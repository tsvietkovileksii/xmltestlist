<?php

namespace App\Services;

use App\Contracts\ApiServiceInterface;

/**
 *
 */
class ApiSwitchService
{
    /**
     * @var ApiServiceInterface
     */
    protected $api1;
    /**
     * @var ApiServiceInterface
     */
    protected $api2;

    /**
     * @param ApiServiceInterface $api1
     * @param ApiServiceInterface $api2
     */
    public function __construct(ApiServiceInterface $api1, ApiServiceInterface $api2)
    {
        $this->api1 = $api1;
        $this->api2 = $api2;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        try {
            return $this->api1->getData();
        } catch (\Exception $e) {
            return $this->api2->getData();
        }
    }
}
