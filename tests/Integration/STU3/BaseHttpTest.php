<?php

namespace Endeavors\Fhir\Http\Api\Tests\Integration\STU3;

use GuzzleHttp\Client;
use Nyholm\Psr7\Request;
use PHPUnit\Framework\TestCase;
use Endeavors\Fhir\Http\Api\Three\Clinical;
use Endeavors\Fhir\Http\Api\Tests\Mocks\GuzzlePsr18Client;
use Psr\Http\Client\ClientInterface;
use GuzzleHttp\Exception\RequestException;
use Nyholm\Psr7\Response;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use Endeavors\Fhir\Http\Api\Three\Facade\Clinical as ClinicalFacade;

/**
 * [BaseHttpTest description]
 * @todo test other non standard http methods
 */
class BaseHttpTest extends TestCase
{
    /**
     * @test
     */
    public function missingAcceptHeader()
    {
        $client = new Client();

        $psr18Client = new GuzzlePsr18Client($client);

        $clinical = new Clinical($psr18Client);

        $this->expectException(\InvalidArgumentException::class);

        // Clinical Summary
        $response = $clinical
        ->sendRequest(
            new Request(
                'GET',
                'http://missingacceptheader/fails',
                ['Authorization' => 'Bearer token']
            )
        );
    }

    /**
     * @test
     */
    public function missingAuthorizationHeader()
    {
        $client = new Client();

        $psr18Client = new GuzzlePsr18Client($client);

        $clinical = new Clinical($psr18Client);

        $this->expectException(\InvalidArgumentException::class);

        // Clinical Summary
        $response = $clinical
        ->sendRequest(
            new Request(
                'GET',
                'http://missingauthorizationheader/fails',
                ['Accept' => 'application/json']
            )
        );
    }

    /**
     * @test
     */
    public function nullAuthorizationHeader()
    {
        $client = new Client();

        $psr18Client = new GuzzlePsr18Client($client);

        $clinical = new Clinical($psr18Client);

        $this->expectException(\InvalidArgumentException::class);

        // Clinical Summary
        $response = $clinical
        ->sendRequest(
            new Request(
                'GET',
                'http://missingauthorizationheader/fails',
                [
                    'Accept' => 'application/json',
                    'Authorization' => null
                ]
            )
        );
    }

    /**
     * @test
     */
    public function nullAcceptHeader()
    {
        $client = new Client();

        $psr18Client = new GuzzlePsr18Client($client);

        $clinical = new Clinical($psr18Client);

        $this->expectException(\InvalidArgumentException::class);

        // Clinical Summary
        $response = $clinical
        ->sendRequest(
            new Request(
                'GET',
                'http://missingacceptheader/fails',
                [
                    'Accept' => null,
                    'Authorization' => 'Bearer token'
                ]
            )
        );
    }

    /**
     * Only Standardized Http methods
     * @test
     */
    public function standardizedHttpMethods()
    {
        $mock = new MockHandler([
            // Clinical Summary responses
            new Response(200, ['X-Foo' => 'Bar'], 'GET'),
            new Response(200, ['X-Foo' => 'Bar'], 'HEAD'),
            new Response(200, ['X-Foo' => 'Bar'], 'POST'),
            new Response(200, ['X-Foo' => 'Bar'], 'PUT'),
            new Response(200, ['X-Foo' => 'Bar'], 'DELETE'),
            new Response(200, ['X-Foo' => 'Bar'], 'CONNECT'),
            new Response(200, ['X-Foo' => 'Bar'], 'OPTIONS'),
            new Response(200, ['X-Foo' => 'Bar'], 'TRACE'),
        ]);

        $handlerStack = HandlerStack::create($mock);

        $client = new Client(['handler' => $handlerStack]);

        $psr18Client = new GuzzlePsr18Client($client);

        $clinical = new Clinical($psr18Client);

        $response = $clinical
        ->sendRequest(
            new Request(
                'GET',
                'http://host/get',
                [
                    'Accept' => '',
                    'Authorization' => 'Bearer token'
                ]
            )
        );

        $this->assertSame((string)$response->getBody(), 'GET');

        $response = $clinical
        ->sendRequest(
            new Request(
                'HEAD',
                'http://host/head',
                [
                    'Accept' => '',
                    'Authorization' => 'Bearer token'
                ]
            )
        );

        $this->assertSame((string)$response->getBody(), 'HEAD');

        $response = $clinical
        ->sendRequest(
            new Request(
                'POST',
                'http://host/post',
                [
                    'Accept' => '',
                    'Authorization' => 'Bearer token',
                    'content-type' => 'x'
                ]
            )
        );

        $this->assertSame((string)$response->getBody(), 'POST');

        $response = $clinical
        ->sendRequest(
            new Request(
                'PUT',
                'http://host/put',
                [
                    'Accept' => '',
                    'Authorization' => 'Bearer token',
                    'content-type' => 'x'
                ]
            )
        );

        $this->assertSame((string)$response->getBody(), 'PUT');

        $response = $clinical
        ->sendRequest(
            new Request(
                'DELETE',
                'http://host/delete',
                [
                    'Accept' => '',
                    'Authorization' => 'Bearer token',
                ]
            )
        );

        $this->assertSame((string)$response->getBody(), 'DELETE');

        $response = $clinical
        ->sendRequest(
            new Request(
                'CONNECT',
                'http://host/connect',
                [
                    'Accept' => '',
                    'Authorization' => 'Bearer token',
                ]
            )
        );

        $this->assertSame((string)$response->getBody(), 'CONNECT');

        $response = $clinical
        ->sendRequest(
            new Request(
                'OPTIONS',
                'http://host/options',
                [
                    'Accept' => '',
                    'Authorization' => 'Bearer token',
                ]
            )
        );

        $this->assertSame((string)$response->getBody(), 'OPTIONS');

        $response = $clinical
        ->sendRequest(
            new Request(
                'TRACE',
                'http://host/trace',
                [
                    'Accept' => '',
                    'Authorization' => 'Bearer token',
                ]
            )
        );

        $this->assertSame((string)$response->getBody(), 'TRACE');
    }

    /**
     * ACL HTTP Method
     * @test
     */
    public function aclHttpMethod()
    {
        $client = new Client();

        $psr18Client = new GuzzlePsr18Client($client);

        $clinical = new Clinical($psr18Client);

        $this->expectException(\InvalidArgumentException::class);

        $response = $clinical
        ->sendRequest(
            new Request(
                'ACL',
                'http://host/acl',
                [
                    'Accept' => '',
                    'Authorization' => 'Bearer token'
                ]
            )
        );
    }

    /**
     * BIND HTTP Method
     * @test
     */
    public function bindHttpMethod()
    {
        $client = new Client();

        $psr18Client = new GuzzlePsr18Client($client);

        $clinical = new Clinical($psr18Client);

        $this->expectException(\InvalidArgumentException::class);

        $response = $clinical
        ->sendRequest(
            new Request(
                'BIND',
                'http://host/bind',
                [
                    'Accept' => '',
                    'Authorization' => 'Bearer token'
                ]
            )
        );
    }

    /**
     * CHECKIN HTTP Method
     * @test
     */
    public function checkInHttpMethod()
    {
        $client = new Client();

        $psr18Client = new GuzzlePsr18Client($client);

        $clinical = new Clinical($psr18Client);

        $this->expectException(\InvalidArgumentException::class);

        $response = $clinical
        ->sendRequest(
            new Request(
                'CHECKIN',
                'http://host/checkin',
                [
                    'Accept' => '',
                    'Authorization' => 'Bearer token'
                ]
            )
        );
    }
}
