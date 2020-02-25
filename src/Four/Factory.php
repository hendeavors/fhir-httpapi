<?php

declare(strict_types=1);

namespace Endeavors\Fhir\Http\Api\Four;

use Nyholm\Psr7\Stream;
use Nyholm\Psr7\Request;
use Endeavors\Fhir\Http\Api\Uri\Read;
use Endeavors\Fhir\Http\Api\Uri\Write;
use Endeavors\Fhir\Http\Api\Uri\Search;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Client\ClientInterface;
use Endeavors\Fhir\Http\Api\Four\Facade\Clinical;
use Psr\Http\Message\{RequestInterface, ResponseInterface};

/**
 * [final description]
 * @var [type]
 */
final class Factory implements RequestFactoryInterface
{
    private static $instance = null;

    private $httpClient = null;

    private function __construct(ClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    public static function withHttpClient(ClientInterface $httpClient)
    {
        if (null === static::$instance) {
            static::$instance = new static($httpClient);
        }
    }

    public static function getInstance()
    {
        if (null === static::$instance) {
            throw new LogicException(
                "A Psr18 http client is required to make requests."
            );
        }

        return static::$instance;
    }

    /**
     * Read condition resource
     * @param  string $uri The uri for reading a condition
     * @return ResponseInterface The response in json fhir format
     */
    public static function readCondition($uri, string $authorization): ResponseInterface
    {
        $request = static::getInstance()->getRequest(Read::make($uri));

        $request = $request
        ->withHeader('accept', [
            'application/json',
            'application/fhir+json'
        ])->withHeader('authorization', $authorization);

        return Clinical::condition(
            static::getInstance()->httpClient,
            $request
        );
    }

    /**
     * Search condition resource
     * @param  string $uri The uri for searching a condition
     * @return ResponseInterface The response in json fhir format
     */
    public static function searchCondition($uri, string $authorization): ResponseInterface
    {
        $request = static::getInstance()->getRequest(Search::make($uri));

        $request = $request
        ->withHeader('accept', [
            'application/json',
            'application/fhir+json'
        ])->withHeader('authorization', $authorization);

        return Clinical::condition(
            $request,
            static::getInstance()->httpClient
        );
    }

    /**
     * Create condition resource
     * @param  string $uri The uri for creating a condition
     * @param  string|resource|StreamInterface $body Request body
     * @return ResponseInterface The response in json fhir format
     */
    public static function createCondition($uri, $body, string $authorization): ResponseInterface
    {
        $request = static::getInstance()
        ->postRequest(Write::make($uri))
        ->withBody(Stream::create($body))
        ->withHeader('accept', [
            'application/json',
            'application/fhir+json'
        ])
        ->withHeader('content-type', [
            'application/fhir+json'
        ])
        ->withHeader('authorization', $authorization);

        return Clinical::condition(static::getInstance()->httpClient, $request);
    }

    public function createRequest(string $method, $uri): RequestInterface
    {
        return new Request($method, $uri);
    }

    protected function getRequest($uri): RequestInterface
    {
        return $this->createRequest('GET', $uri);
    }

    protected function postRequest($uri): RequestInterface
    {
        return $this->createRequest('POST', $uri);
    }
}
