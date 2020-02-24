<?php

namespace Endeavors\Fhir\Http\Api\Tests\Mocks;

use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Client;

class GuzzlePsr18Client implements ClientInterface
{
    private $guzzle;

    public function __construct(Client $guzzle)
    {
        $this->guzzle = $guzzle;
    }

    public function sendRequest(RequestInterface $request): ResponseInterface
    {
        return $this->guzzle->send($request);
    }
}
