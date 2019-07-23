<?php
namespace App\Controller\Api;

use GuzzleHttp\Client;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class BaseController {

    /**
     * @var Request|null
     */
    protected $request = null;

    /**
     * @var Client
     */
    protected $client = null;


    public function __construct()
    {
        $this->request = Request::createFromGlobals();
        $this->client = new Client();
    }

    public function request()
    {
        $request = $this->request;
        if (0 === strpos($request->headers->get('Content-Type'), 'application/json')) {
            $data = json_decode($request->getContent(), true);
            $request->request->replace(is_array($data) ? $data : array());
        }
        return $request->request;
    }

    public function response(array $data) : JsonResponse
    {
        return new JsonResponse($data);
    }
}