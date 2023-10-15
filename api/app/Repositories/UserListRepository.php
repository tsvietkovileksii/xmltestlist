<?php

namespace App\Repositories;

use App\Services\ApiSwitchService;
use SimpleXMLElement;

/**
 *
 */
class UserListRepository
{
    /**
     * @var ApiSwitchService
     */
    protected $api;

    /**
     * @param ApiSwitchService $api
     */
    public function __construct(ApiSwitchService $api)
    {
        $this->api = $api;
    }

    /**
     * @return bool|string
     */
    public function getData()
    {
        $data = [];

        for ($i = 0; $i < 10; $i++) {
            $getData = $this->api->getData();
            if(!empty($getData['lastName'])) {
                $data[$getData['lastName']] = $getData;
            }
        }

        krsort($data);

        $xml = new SimpleXMLElement('<data></data>');

        foreach ($data as $item) {
            if(!empty($item['fullName']) && !empty($item['phone']) && !empty($item['email']) && !empty($item['country'])) {
                $entry = $xml->addChild('entry');
                $entry->addChild('fullName', $item['fullName']);
                $entry->addChild('phone', $item['phone']);
                $entry->addChild('email', $item['email']);
                $entry->addChild('country', $item['country']);
            }
        }

        return $xml->asXML();
    }


}
