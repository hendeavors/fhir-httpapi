<?php

declare(strict_types=1);

namespace Endeavors\Fhir\Http\Api\Four;

use Endeavors\Fhir\Http\Contracts\Clinical\Four\Clinical as ClinicalContract;
use Psr\Http\Message\{RequestInterface, ResponseInterface, UriInterface};
use Endeavors\Fhir\Http\Api\Support\AssertValidRequest;
use Psr\Http\Client\ClientInterface;
use InvalidArgumentException;

/**
 * [Clinical description]
 * @todo Prefer: return=minimal
 * Prefer: return=representation
 * Prefer: return=OperationOutcome
 * Servers SHOULD honor this header(Prefer)
 * In the absence of the header, servers may choose whether to return the full resource or
 * not (but not the OperationOutcome; that should only be returned if explicitly requested).
 * Note that this setting only applies to successful interactions. In case of failure,
 * servers SHOULD always return a body that contains an OperationOutcome resource.
 */
class Clinical implements ClinicalContract, ClientInterface
{
    use AssertValidRequest;

    private $httpClient;

    private $fhirVersion = '';

    public function __construct(ClientInterface $httpClient, ?string $fhirVersion = '4.0')
    {
        $this->httpClient = $httpClient;

        $this->fhirVersion = $fhirVersion ?? '4.0';

        if (!\is_numeric($this->fhirVersion)) {
            throw new InvalidArgumentException("FHIR Version must be numeric. Example 4.0. See https://www.hl7.org/fhir/r4/http.html#version-parameter");
        }
    }

    public function withDefaultFhirVersion()
    {
        return new Clinical($this->httpClient, null);
    }

    public function usingDefaultFhirVersion()
    {
        return $this->withDefaultFhirVersion();
    }

    /**
     * [carePlan description]
     * @param  RequestInterface  $request [description]
     * @return ResponseInterface          [description]
     */
    public function carePlan(RequestInterface $request): ResponseInterface
    {
        return $this->sendRequest($request);
    }

    /**
     * [careTeam description]
     * @param  RequestInterface  $request [description]
     * @return ResponseInterface          [description]
     */
    public function careTeam(RequestInterface $request): ResponseInterface
    {
        return $this->sendRequest($request);
    }

    /**
     * [goal description]
     * @param  RequestInterface  $request [description]
     * @return ResponseInterface          [description]
     */
    public function goal(RequestInterface $request): ResponseInterface
    {
        return $this->sendRequest($request);
    }

    /**
     * [serviceRequest description]
     * @param  RequestInterface  $request [description]
     * @return ResponseInterface          [description]
     */
    public function serviceRequest(RequestInterface $request): ResponseInterface
    {
        return $this->sendRequest($request);
    }

    /**
     * [nutritionOrder description]
     * @param  RequestInterface  $request [description]
     * @return ResponseInterface          [description]
     */
    public function nutritionOrder(RequestInterface $request): ResponseInterface
    {
        return $this->sendRequest($request);
    }

    /**
     * [visionPrescription description]
     * @param  RequestInterface  $request [description]
     * @return ResponseInterface          [description]
     */
    public function visionPrescription(RequestInterface $request): ResponseInterface
    {
        return $this->sendRequest($request);
    }

    /**
     * [riskAssessment description]
     * @param  RequestInterface  $request [description]
     * @return ResponseInterface          [description]
     */
    public function riskAssessment(RequestInterface $request): ResponseInterface
    {
        return $this->sendRequest($request);
    }

    /**
     * [requestGroup description]
     * @param  RequestInterface  $request [description]
     * @return ResponseInterface          [description]
     */
    public function requestGroup(RequestInterface $request): ResponseInterface
    {
        return $this->sendRequest($request);
    }

    /**
     * [observation description]
     * @param  RequestInterface  $request [description]
     * @return ResponseInterface          [description]
     */
    public function observation(RequestInterface $request): ResponseInterface
    {
        return $this->sendRequest($request);
    }

    /**
     * [media description]
     * @param  RequestInterface  $request [description]
     * @return ResponseInterface          [description]
     */
    public function media(RequestInterface $request): ResponseInterface
    {
        return $this->sendRequest($request);
    }

    /**
     * [diagnosticReport description]
     * @param  RequestInterface  $request [description]
     * @return ResponseInterface          [description]
     */
    public function diagnosticReport(RequestInterface $request): ResponseInterface
    {
        return $this->sendRequest($request);
    }

    /**
     * [specimen description]
     * @param  RequestInterface  $request [description]
     * @return ResponseInterface          [description]
     */
    public function specimen(RequestInterface $request): ResponseInterface
    {
        return $this->sendRequest($request);
    }

    /**
     * [bodyStructure description]
     * @param  RequestInterface  $request [description]
     * @return ResponseInterface          [description]
     */
    public function bodyStructure(RequestInterface $request): ResponseInterface
    {
        return $this->sendRequest($request);
    }

    /**
     * [imagingStudy description]
     * @param  RequestInterface  $request [description]
     * @return ResponseInterface          [description]
     */
    public function imagingStudy(RequestInterface $request): ResponseInterface
    {
        return $this->sendRequest($request);
    }

    /**
     * [molecularSequence description]
     * @param  RequestInterface  $request [description]
     * @return ResponseInterface          [description]
     */
    public function molecularSequence(RequestInterface $request): ResponseInterface
    {
        return $this->sendRequest($request);
    }

    /**
     * Medication Request resource
     * @param  RequestInterface  $request psr7 request
     * @return ResponseInterface psr7 Medication Request response
     */
    public function medicationRequest(RequestInterface $request): ResponseInterface
    {
        return $this->sendRequest($request);
    }

    /**
     * Medication Administration Resource
     * @param  RequestInterface  $request [description]
     * @return ResponseInterface          [description]
     */
    public function medicationAdministration(RequestInterface $request): ResponseInterface
    {
        return $this->sendRequest($request);
    }

    /**
     * Medication Dispense resource
     * @param  RequestInterface  $request [description]
     * @return ResponseInterface          [description]
     */
    public function medicationDispense(RequestInterface $request): ResponseInterface
    {
        return $this->sendRequest($request);
    }

    /**
     * Medication Statement resource
     * @param  RequestInterface  $request [description]
     * @return ResponseInterface          [description]
     */
    public function medicationStatement(RequestInterface $request): ResponseInterface
    {
        return $this->sendRequest($request);
    }

    /**
     * Medication resource
     * @param  RequestInterface  $request [description]
     * @return ResponseInterface          [description]
     */
    public function medication(RequestInterface $request): ResponseInterface
    {
        return $this->sendRequest($request);
    }

    /**
     * Medication knowledge resource
     * @param  RequestInterface  $request [description]
     * @return ResponseInterface          [description]
     */
    public function medicationKnowledge(RequestInterface $request): ResponseInterface
    {
        return $this->sendRequest($request);
    }

    /**
     * Immunization resource
     * @param  RequestInterface  $request [description]
     * @return ResponseInterface          [description]
     */
    public function immunization(RequestInterface $request): ResponseInterface
    {
        return $this->sendRequest($request);
    }

    /**
     * Immunization Evaluation resource
     * @param  RequestInterface  $request [description]
     * @return ResponseInterface          [description]
     */
    public function immunizationEvaluation(RequestInterface $request): ResponseInterface
    {
        return $this->sendRequest($request);
    }

    /**
     * Immunization Recommendation resource
     * @param  RequestInterface  $request [description]
     * @return ResponseInterface          [description]
     */
    public function immunizationRecommendation(RequestInterface $request): ResponseInterface
    {
        return $this->sendRequest($request);
    }

    /**
     * The allergy tolerance resource
     * @param  RequestInterface $request psr7 request
     * @return ResponseInterface $response The psr7 allergy tolerance response
     */
    public function allergyTolerance(RequestInterface $request): ResponseInterface
    {
        return $this->sendRequest($request);
    }

    /**
     * The adverse event resource
     * @param  RequestInterface $request psr7 request
     * @return ResponseInterface $response The psr7 adverse event response
     */
    public function adverseEvent(RequestInterface $request): ResponseInterface
    {
        return $this->sendRequest($request);
    }

    /**
     * The Condition resource
     * @param  RequestInterface $request psr7 request
     * @return ResponseInterface $response The psr7 condition response
     */
    public function condition(RequestInterface $request): ResponseInterface
    {
        if ($request->getMethod() === 'POST') {
            // TODO subject is required
        }

        return $this->sendRequest($request);
    }

    /**
     * The Procedure resource
     * @param  RequestInterface $request psr7 request
     * @return ResponseInterface $response The psr7 condition response
     */
    public function procedure(RequestInterface $request): ResponseInterface
    {
        return $this->sendRequest($request);
    }

    /**
     * The Family Member History resource request
     * @param  RequestInterface $request psr7 request
     * @return ResponseInterface $response The psr7 family member history response
     */
    public function familyMemberHistory(RequestInterface $request): ResponseInterface
    {
        return $this->sendRequest($request);
    }

    /**
     * The clinical Impression resource request
     * @param  RequestInterface $request psr7 request
     * @return ResponseInterface $response The psr7 clinical impression response
     */
    public function clinicalImpression(RequestInterface $request): ResponseInterface
    {
        return $this->sendRequest($request);
    }

    /**
     * The Detected Issue resource
     * @param  RequestInterface  $request [description]
     * @return ResponseInterface          [description]
     */
    public function detectedIssue(RequestInterface $request): ResponseInterface
    {
        return $this->sendRequest($request);
    }

    /**
     * Sends a PSR-7 request and returns a PSR-7 response.
     * @param RequestInterface $request
     * @return ResponseInterface
     * @throws \Psr\Http\Client\ClientExceptionInterface If an error happens while processing the request.
     * @todo https://www.hl7.org/fhir/R4/http.html#version-parameter
     */
    public function sendRequest(RequestInterface $request): ResponseInterface
    {
        $this->validatesRequiredHeaders($request);

        $this->validateStandardizedHttpMethod($request);

        $this->validateContainsPath($request->getUri());

        if ((float)$this->fhirVersion >= 5) {
            throw new InvalidArgumentException(
                sprintf("The publication [%s] is not yet supported by this client.", $this->fhirVersion)
            );
        }

        $fhirVersionHeaderValue = 'fhirVersion=' . $this->fhirVersion;

        $acceptHeader = $request->getHeader('accept')[0];
        // Accept: application/fhir+json; fhirVersion=4.0
        // https://www.hl7.org/fhir/r4/http.html#version-parameter
        if ('' === $acceptHeader) {
            $acceptHeader = $fhirVersionHeaderValue;
            $request = $request->withHeader('accept', $acceptHeader);
        } elseif ('' !== $acceptHeader) {
            $rtrimmed = rtrim($acceptHeader, '; ');
            $acceptHeader = $rtrimmed .= '; ' . $fhirVersionHeaderValue;
            $request = $request->withHeader('accept', $acceptHeader);
        }

        return $this->httpClient->sendRequest($request);
    }
}
