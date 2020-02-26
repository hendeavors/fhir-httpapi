<?php

namespace Endeavors\Fhir\Http\Api\Three;

use Endeavors\Fhir\Http\Contracts\Clinical\Three\Clinical as ClinicalContract;
use Psr\Http\Message\{RequestInterface, ResponseInterface, UriInterface};
use Endeavors\Fhir\Http\Api\Support\AssertValidRequest;
use Psr\Http\Client\ClientInterface;
use InvalidArgumentException;

/**
 * [Clinical description]
 * @todo optional preflight check - we don't know what fhir servers support
 */
class Clinical implements ClinicalContract, ClientInterface
{
    use AssertValidRequest;

    private $httpClient;

    public function __construct(ClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * The CareTeam resource request
     *
     * @param  RequestInterface  $request [description]
     * @return ResponseInterface          [description]
     */
    public function careTeam(RequestInterface $request): ResponseInterface
    {
        return $this->sendRequest($request);
    }

    /**
     * The ReferralRequest resource request
     *
     * @param  RequestInterface  $request [description]
     * @return ResponseInterface          [description]
     */
    public function referralRequest(RequestInterface $request): ResponseInterface
    {
        return $this->sendRequest($request);
    }

    /**
     * ProcedureRequest resource
     * @param  RequestInterface  $request [description]
     * @return ResponseInterface          [description]
     */
    public function procedureRequest(RequestInterface $request): ResponseInterface
    {
        return $this->sendRequest($request);
    }

    /**
     * RiskAssessment resource
     * @param  RequestInterface  $request [description]
     * @return ResponseInterface          [description]
     */
    public function riskAssessment(RequestInterface $request): ResponseInterface
    {
        return $this->sendRequest($request);
    }

    /**
     * RequestGroup resource
     * @param  RequestInterface  $request [description]
     * @return ResponseInterface          [description]
     */
    public function requestGroup(RequestInterface $request): ResponseInterface
    {
        return $this->sendRequest($request);
    }

    /**
     * CarePlan resource
     * @param  RequestInterface  $request [description]
     * @return ResponseInterface          [description]
     */
    public function carePlan(RequestInterface $request): ResponseInterface
    {
        return $this->sendRequest($request);
    }

    /**
     * Goal resource
     * @param  RequestInterface  $request [description]
     * @return ResponseInterface          [description]
     */
    public function goal(RequestInterface $request): ResponseInterface
    {
        return $this->sendRequest($request);
    }

    /**
     * NutritionOrder resource
     * @param  RequestInterface  $request [description]
     * @return ResponseInterface          [description]
     */
    public function nutritionOrder(RequestInterface $request): ResponseInterface
    {
        return $this->sendRequest($request);
    }

    /**
     * VisionPrescription resource
     * @param  RequestInterface  $request [description]
     * @return ResponseInterface          [description]
     */
    public function visionPrescription(RequestInterface $request): ResponseInterface
    {
        return $this->sendRequest($request);
    }

    /**
     * Observation resource
     * @param  RequestInterface  $request [description]
     * @return ResponseInterface          [description]
     */
    public function observation(RequestInterface $request): ResponseInterface
    {
        return $this->sendRequest($request);
    }

    /**
     * DiagnosticReport resource
     * @param  RequestInterface  $request [description]
     * @return ResponseInterface          [description]
     */
    public function diagnosticReport(RequestInterface $request): ResponseInterface
    {
        return $this->sendRequest($request);
    }

    /**
     * Specimen resource
     * @param  RequestInterface  $request [description]
     * @return ResponseInterface          [description]
     */
    public function specimen(RequestInterface $request): ResponseInterface
    {
        return $this->sendRequest($request);
    }

    /**
     * BodySite resource
     * @param  RequestInterface  $request [description]
     * @return ResponseInterface          [description]
     */
    public function bodySite(RequestInterface $request): ResponseInterface
    {
        return $this->sendRequest($request);
    }

    /**
     * ImagingStudy resource
     * @param  RequestInterface  $request [description]
     * @return ResponseInterface          [description]
     */
    public function imagingStudy(RequestInterface $request): ResponseInterface
    {
        return $this->sendRequest($request);
    }

    /**
     * ImagingManifest resource
     * @param  RequestInterface  $request psr7 request
     * @return ResponseInterface $response the psr7 imaging request response
     */
    public function imagingManifest(RequestInterface $request): ResponseInterface
    {
        return $this->sendRequest($request);
    }

    /**
     * [sequence description]
     * @param  RequestInterface  $request [description]
     * @return ResponseInterface          [description]
     */
    public function sequence(RequestInterface $request): ResponseInterface
    {
        return $this->sendRequest($request);
    }

    /**
     * The Adverse event resource
     * @param  RequestInterface $request psr7 request
     * @return ResponseInterface $response The psr7 adverse event response
     */
    public function adverseEvent(RequestInterface $request): ResponseInterface
    {
        return $this->sendRequest($request);
    }

    /**
     * The Allergy tolerance resource
     * @param  RequestInterface $request psr7 request
     * @return ResponseInterface $response The psr7 allergy tolerance response
     */
    public function allergyTolerance(RequestInterface $request): ResponseInterface
    {
        return $this->sendRequest($request);
    }

    /**
     * The Condition resource (Problem)
     * @param  RequestInterface $request psr7 request
     * @return ResponseInterface $response The psr7 condition response
     */
    public function condition(RequestInterface $request): ResponseInterface
    {
        return $this->sendRequest($request);
    }

    /**
     * The Prodecure Resource
     * @param  RequestInterface  $request [description]
     * @return ResponseInterface          [description]
     */
    public function procedure(RequestInterface $request): ResponseInterface
    {
        return $this->sendRequest($request);
    }

    /**
     * The Family Member History resource
     * @param  RequestInterface $request psr7 request
     * @return ResponseInterface $response The psr7 family member history response
     */
    public function familyMemberHistory(RequestInterface $request): ResponseInterface
    {
        return $this->sendRequest($request);
    }

    /**
     * The clinical impression resource
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
     */
    public function sendRequest(RequestInterface $request): ResponseInterface
    {
        $this->validatesRequiredHeaders($request);

        $this->validateStandardizedHttpMethod($request);

        $this->validateContainsPath($request->getUri());

        return $this->httpClient->sendRequest($request);
    }
}
