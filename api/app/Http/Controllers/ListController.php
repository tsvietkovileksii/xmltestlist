<?php

namespace App\Http\Controllers;

use App\Services\BoredApiService;
use Illuminate\Http\Request;
use App\Repositories\UserListRepository;
use SimpleXMLElement;

class ListController extends Controller
{
    protected $userListRepository;

    public function __construct(UserListRepository $userListRepository) {
        $this->userListRepository = $userListRepository;
    }

    public function index()
    {
        try {
            $listXml = $this->userListRepository->getData();

            return response($listXml, 200)
                ->header('Content-Type', 'application/xml');
        } catch (\Exception $e) {

            return (new SimpleXMLElement('<data>'.$e->getMessage().'</data>'))->asXML();
        }
    }
}
