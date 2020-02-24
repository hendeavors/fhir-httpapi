<?php

namespace Endeavors\Fhir\Http\Api\Tests\Integration\R4;

use PHPUnit\Framework\TestCase;
use Endeavors\Fhir\Http\Api\Four\Factory;
use GuzzleHttp\Client;
use Nyholm\Psr7\Request;
use Nyholm\Psr7\ServerRequest;
use Nyholm\Psr7\Response;
use Endeavors\Fhir\Http\Api\Tests\Mocks\GuzzlePsr18Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;

class FactoryTest extends TestCase
{
    /**
     * condition
     * @test
     */
    public function condition()
    {
        $mock = new MockHandler([
            // Clinical Summary responses
            new Response(200, ['X-Foo' => 'Bar'], 'Read Condition'),
            new Response(200, ['X-Foo' => 'Bar'], 'Create Condition'),
            new Response(200, ['X-Foo' => 'Bar'], 'Condition'),
            new Response(200, ['X-Foo' => 'Bar'], 'Procedure'),
            new Response(200, ['X-Foo' => 'Bar'], 'Family Member History'),
            new Response(200, ['X-Foo' => 'Bar'], 'Clinical Impression'),
            new Response(200, ['X-Foo' => 'Bar'], 'Detected Issue'),
            // Care Provision responses
            new Response(200, ['X-Foo' => 'Bar'], 'Care Plan'),
            new Response(200, ['X-Foo' => 'Bar'], 'Care Team'),
            new Response(200, ['X-Foo' => 'Bar'], 'Goal'),
            new Response(200, ['X-Foo' => 'Bar'], 'Service Request'),
            new Response(200, ['X-Foo' => 'Bar'], 'Nutrition Order'),
            new Response(200, ['X-Foo' => 'Bar'], 'Vision Prescription'),
            new Response(200, ['X-Foo' => 'Bar'], 'Risk Assessment'),
            new Response(200, ['X-Foo' => 'Bar'], 'Request Group'),
        ]);

        $handlerStack = HandlerStack::create($mock);

        $client = new Client(['handler' => $handlerStack]);

        $psr18Client = new GuzzlePsr18Client($client);

        Factory::withHttpClient($psr18Client);

        $response = Factory::readCondition("/readcondition", "Bearer token1");

        $this->assertSame((string)$response->getBody(), 'Read Condition');

        $response = Factory::createCondition("/createcondition", "", "Bearer token2");

        $this->assertSame((string)$response->getBody(), 'Create Condition');
    }
}
