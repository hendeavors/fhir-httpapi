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

class FhirVersionTest extends TestCase
{
    /**
     * @test
     */
    public function fromFacade()
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
        // Clinical Summary
        $response = ClinicalFacade::allergyTolerance(
            new Request('GET', 'http://fhirserver/allergytolerance', [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer token'
            ]),
            $psr18Client,
            '4.0'
        );

        $this->assertSame('Allergy Tolerance', (string)$response->getBody());

        $response = ClinicalFacade::adverseEvent(
            new Request('GET', 'http://fhirserver/careteam', [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer token'
            ]),
            $psr18Client,
            '4.0'
        );

        $this->assertSame('Adverse Event', (string)$response->getBody());

        $response = ClinicalFacade::condition(
            $psr18Client,
            new Request('GET', 'http://fhirserver/careteam', [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer token'
            ]),
            '4.0'
        );

        $this->assertSame('Condition', (string)$response->getBody());

        $response = ClinicalFacade::procedure(
            $psr18Client,
            new Request('GET', 'http://fhirserver/careteam', [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer token'
            ]),
            '4.0'
        );

        $this->assertSame('Procedure', (string)$response->getBody());

        $response = ClinicalFacade::familyMemberHistory(
            $psr18Client,
            new Request('GET', 'http://fhirserver/careteam', [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer token'
            ]),
            '4.0'
        );

        $this->assertSame('Family Member History', (string)$response->getBody());

        $response = ClinicalFacade::clinicalImpression(
            $psr18Client,
            new Request('GET', 'http://fhirserver/careteam', [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer token'
            ]),
            '4.0'
        );

        $this->assertSame('Clinical Impression', (string)$response->getBody());

        $response = ClinicalFacade::detectedIssue(
            $psr18Client,
            new Request('GET', 'http://fhirserver/careteam', [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer token'
            ]),
            '4.0'
        );

        $this->assertSame('Detected Issue', (string)$response->getBody());

        // Clinical Care Provision
        $response = ClinicalFacade::carePlan(
            $psr18Client,
            new Request('GET', 'http://fhirserver/careplan', [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer token'
            ]),
            '4.0'
        );

        $this->assertSame('Care Plan', (string)$response->getBody());

        $response = ClinicalFacade::careTeam(
            $psr18Client,
            new Request('GET', 'http://fhirserver/careteam', [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer token'
            ]),
            '4.0'
        );

        $this->assertSame('Care Team', (string)$response->getBody());

        $response = ClinicalFacade::goal(
            $psr18Client,
            new Request('GET', 'http://fhirserver/goal', [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer token'
            ]),
            '4.0'
        );

        $this->assertSame('Goal', (string)$response->getBody());

        $response = ClinicalFacade::serviceRequest(
            $psr18Client,
            new Request('GET', 'http://fhirserver/careteam', [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer token'
            ]),
            '4.0'
        );

        $this->assertSame('Service Request', (string)$response->getBody());

        $response = ClinicalFacade::nutritionOrder(
            $psr18Client,
            new Request('GET', 'http://fhirserver/careteam', [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer token'
            ]),
            '4.0'
        );

        $this->assertSame('Nutrition Order', (string)$response->getBody());

        $response = ClinicalFacade::visionPrescription(
            $psr18Client,
            new Request('GET', 'http://fhirserver/careteam', [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer token'
            ]),
            '4.0'
        );

        $this->assertSame('Vision Prescription', (string)$response->getBody());

        $response = ClinicalFacade::riskAssessment(
            $psr18Client,
            new Request('GET', 'http://fhirserver/careteam', [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer token'
            ]),
            '4.0'
        );

        $this->assertSame('Risk Assessment', (string)$response->getBody());

        $response = ClinicalFacade::requestGroup(
            $psr18Client,
            new Request('GET', 'http://fhirserver/requestgroup', [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer token'
            ]),
            '4.0'
        );

        $this->assertSame('Request Group', (string)$response->getBody());
    }

    /**
     * @test
     */
    public function unsupported()
    {
        $client = new Client();

        $psr18Client = new GuzzlePsr18Client($client);

        $this->expectException(\InvalidArgumentException::class);

        $response = ClinicalFacade::requestGroup(
            $psr18Client,
            new Request('GET', 'http://fhirserver/requestgroup', [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer token'
            ]),
            '5.0'
        );
    }
}
