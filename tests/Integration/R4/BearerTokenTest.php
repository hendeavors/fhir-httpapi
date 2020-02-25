<?php

namespace Endeavors\Fhir\Http\Api\Tests\Integration\R4;

use GuzzleHttp\Client;
use Nyholm\Psr7\Request;
use PHPUnit\Framework\TestCase;
use Endeavors\Fhir\Http\Api\Four\Clinical as FourClinical;
use Endeavors\Fhir\Http\Api\Tests\Mocks\GuzzlePsr18Client;
use Psr\Http\Client\ClientInterface;
use GuzzleHttp\Exception\RequestException;
use Endeavors\Fhir\Http\Api\Four\Facade\Clinical as FourClinicalFacade;
use Nyholm\Psr7\Response;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;

/**
 * BearerTokenTest test the usage of the bear token header
 * https://tools.ietf.org/html/rfc6750#section-2.1
 * Authorization Request Header Field
 * Example: Bearer randomstring
 */
class BearerTokenTest extends TestCase
{
    /**
     * @test
     */
    public function containsBearer()
    {
        $mock = new MockHandler([
            new Response(200, ['X-Foo' => 'Bar'], 'Bearer'),
        ]);

        $handlerStack = HandlerStack::create($mock);

        $client = new Client(['handler' => $handlerStack]);

        $psr18Client = new GuzzlePsr18Client($client);

        $clinical = new FourClinical($psr18Client);

        // Generic request
        $response = $clinical
        ->sendRequest(
            new Request(
                'GET',
                'http://invalidbearertoken/somepath',
                [
                    'Accept' => '',
                    'Authorization' => 'Bearer token'
                ]
            )
        );

        $this->assertSame('Bearer', (string)$response->getBody());
    }

    /**
     * @test
     */
    public function missingBearer()
    {
        $mock = new MockHandler([
            new Response(200, ['X-Foo' => 'Bar'], 'Bearer'),
        ]);

        $handlerStack = HandlerStack::create($mock);

        $client = new Client(['handler' => $handlerStack]);

        $psr18Client = new GuzzlePsr18Client($client);

        $clinical = new FourClinical($psr18Client);

        $this->expectException(\InvalidArgumentException::class);

        // Generic request
        $response = $clinical
        ->sendRequest(
            new Request(
                'GET',
                'http://invalidbearertoken/somepath',
                [
                    'Accept' => '',
                    'Authorization' => 'token'
                ]
            )
        );

        $this->assertSame('Bearer', (string)$response->getBody());
    }

    /**
     * @test
     */
    public function noSpace()
    {
        $mock = new MockHandler([
            new Response(200, ['X-Foo' => 'Bar'], 'Bearer'),
        ]);

        $handlerStack = HandlerStack::create($mock);

        $client = new Client(['handler' => $handlerStack]);

        $psr18Client = new GuzzlePsr18Client($client);

        $clinical = new FourClinical($psr18Client);

        $this->expectException(\InvalidArgumentException::class);

        // Generic request
        $response = $clinical
        ->sendRequest(
            new Request(
                'GET',
                'http://invalidbearertoken/somepath',
                [
                    'Accept' => '',
                    'Authorization' => 'Bearertoken'
                ]
            )
        );

        $this->assertSame('Bearer', (string)$response->getBody());
    }

    /**
     * @test
     */
    public function multipleBearers()
    {
        $mock = new MockHandler([
            new Response(200, ['X-Foo' => 'Bar'], 'Bearer'),
        ]);

        $handlerStack = HandlerStack::create($mock);

        $client = new Client(['handler' => $handlerStack]);

        $psr18Client = new GuzzlePsr18Client($client);

        $clinical = new FourClinical($psr18Client);

        $this->expectException(\InvalidArgumentException::class);

        // Generic request
        $response = $clinical
        ->sendRequest(
            new Request(
                'GET',
                'http://invalidbearertoken/somepath',
                [
                    'Accept' => '',
                    'Authorization' => 'Bearer Bearer token'
                ]
            )
        );

        $this->assertSame('Bearer', (string)$response->getBody());
    }

    /**
     * @test
     */
    public function moreThanOneSpace()
    {
        $mock = new MockHandler([
            new Response(200, ['X-Foo' => 'Bar'], 'Bearer'),
        ]);

        $handlerStack = HandlerStack::create($mock);

        $client = new Client(['handler' => $handlerStack]);

        $psr18Client = new GuzzlePsr18Client($client);

        $clinical = new FourClinical($psr18Client);

        $this->expectException(\InvalidArgumentException::class);

        // Generic request
        $response = $clinical
        ->sendRequest(
            new Request(
                'GET',
                'http://invalidbearertoken/somepath',
                [
                    'Accept' => '',
                    'Authorization' => 'Bearer   token'
                ]
            )
        );

        $this->assertSame('Bearer', (string)$response->getBody());
    }

    /**
     * Almost every example on the internet has an uppercase 'B'
     * @test
     */
    public function lowercase()
    {
        $mock = new MockHandler([
            new Response(200, ['X-Foo' => 'Bar'], 'Bearer'),
        ]);

        $handlerStack = HandlerStack::create($mock);

        $client = new Client(['handler' => $handlerStack]);

        $psr18Client = new GuzzlePsr18Client($client);

        $clinical = new FourClinical($psr18Client);

        $this->expectException(\InvalidArgumentException::class);

        // Generic request
        $response = $clinical
        ->sendRequest(
            new Request(
                'GET',
                'http://invalidbearertoken/somepath',
                [
                    'Accept' => '',
                    'Authorization' => 'bearer token'
                ]
            )
        );

        $this->assertSame('Bearer', (string)$response->getBody());
    }
}
