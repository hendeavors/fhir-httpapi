<?php

namespace Endeavors\Fhir\Http\Api\Tests\Integration\R4;

use GuzzleHttp\Client;
use Nyholm\Psr7\Request;
use Nyholm\Psr7\ServerRequest;
use Nyholm\Psr7\Response;
use PHPUnit\Framework\TestCase;
use Endeavors\Fhir\Http\Api\Four\Clinical;
use Endeavors\Fhir\Http\Api\Tests\Mocks\GuzzlePsr18Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Exception\RequestException;
use Endeavors\Fhir\Http\Api\Four\Facade\Clinical as ClinicalFacade;

class HttpClientTest extends TestCase
{
    /**
     * @test
     */
    public function guzzleHttpGetRequest()
    {
        $mock = new MockHandler([
            // Clinical Summary responses
            new Response(200, ['X-Foo' => 'Bar'], 'Allergy Tolerance'),
            new Response(200, ['X-Foo' => 'Bar'], 'Adverse Event'),
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

        $clinical = (new Clinical($psr18Client))->usingDefaultFhirVersion();

        // Clinical Summary
        $response = $clinical->allergyTolerance(new Request('GET', 'http://fhirserver/allergytolerance', [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer token'
        ]));

        $this->assertSame('Allergy Tolerance', (string)$response->getBody());

        $response = $clinical->adverseEvent(new Request('GET', 'http://fhirserver/careteam', [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer token'
        ]));

        $this->assertSame('Adverse Event', (string)$response->getBody());

        $response = $clinical->condition(new Request('GET', 'http://fhirserver/careteam', [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer token'
        ]));

        $this->assertSame('Condition', (string)$response->getBody());

        $response = $clinical->procedure(new Request('GET', 'http://fhirserver/careteam', [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer token'
        ]));

        $this->assertSame('Procedure', (string)$response->getBody());

        $response = $clinical->familyMemberHistory(new Request('GET', 'http://fhirserver/careteam', [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer token'
        ]));

        $this->assertSame('Family Member History', (string)$response->getBody());

        $response = $clinical->clinicalImpression(new Request('GET', 'http://fhirserver/careteam', [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer token'
        ]));

        $this->assertSame('Clinical Impression', (string)$response->getBody());

        $response = $clinical->detectedIssue(new Request('GET', 'http://fhirserver/careteam', [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer token'
        ]));

        $this->assertSame('Detected Issue', (string)$response->getBody());

        // Clinical Care Provision
        $response = $clinical->carePlan(new Request('GET', 'http://fhirserver/careplan', [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer token'
        ]));

        $this->assertSame('Care Plan', (string)$response->getBody());

        $response = $clinical->careTeam(new Request('GET', 'http://fhirserver/careteam', [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer token'
        ]));

        $this->assertSame('Care Team', (string)$response->getBody());

        $response = $clinical->goal(new Request('GET', 'http://fhirserver/goal', [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer token'
        ]));

        $this->assertSame('Goal', (string)$response->getBody());

        $response = $clinical->serviceRequest(new Request('GET', 'http://fhirserver/careteam', [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer token'
        ]));

        $this->assertSame('Service Request', (string)$response->getBody());

        $response = $clinical->nutritionOrder(new Request('GET', 'http://fhirserver/careteam', [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer token'
        ]));

        $this->assertSame('Nutrition Order', (string)$response->getBody());

        $response = $clinical->visionPrescription(new Request('GET', 'http://fhirserver/careteam', [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer token'
        ]));

        $this->assertSame('Vision Prescription', (string)$response->getBody());

        $response = $clinical->riskAssessment(new Request('GET', 'http://fhirserver/careteam', [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer token'
        ]));

        $this->assertSame('Risk Assessment', (string)$response->getBody());

        $response = $clinical->requestGroup(new Request('GET', 'http://fhirserver/careteam', [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer token'
        ]));

        $this->assertSame('Request Group', (string)$response->getBody());
    }

    /**
     * @test
     */
    public function guzzleHttpGetRequestFromFacade()
    {
        $mock = new MockHandler([
            new Response(200, ['X-Foo' => 'Bar'], 'Allergy Tolerance'),
            new Response(200, ['X-Foo' => 'Bar'], 'Allergy Tolerance'),
            new Response(200, ['X-Foo' => 'Bar'], 'Condition'),
        ]);

        $handlerStack = HandlerStack::create($mock);

        $client = new Client(['handler' => $handlerStack]);

        $psr18Client = new GuzzlePsr18Client($client);

        $response = ClinicalFacade::allergyTolerance(
            $psr18Client,
            new Request('GET', 'http://fhirserver/allergytolerance', [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer token'
            ])
        );

        $this->assertSame('Allergy Tolerance', (string)$response->getBody());
        // Arguments can be reversed
        $response = ClinicalFacade::allergyTolerance(
            new Request('GET', 'http://fhirserver/allergytolerance', [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer token'
            ]),
            $psr18Client
        );

        $this->assertSame('Allergy Tolerance', (string)$response->getBody());

        $response = ClinicalFacade::condition(
            new Request('GET', 'http://fhirserver/allergytolerance', [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer token'
            ]),
            $psr18Client
        );

        $this->assertSame('Condition', (string)$response->getBody());
    }
}
