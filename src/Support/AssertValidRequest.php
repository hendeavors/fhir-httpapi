<?php

namespace Endeavors\Fhir\Http\Api\Support;

use Psr\Http\Message\{RequestInterface, UriInterface};
use InvalidArgumentException;

trait AssertValidRequest
{
    /**
     * Validate the path existence e.g. http://fhirserver/api/DSTU2/patient
     * @param  UriInterface $uri The psr7 URI
     * @return void
     * @throws \InvalidArgumentException
     */
    protected function validateContainsPath(UriInterface $uri)
    {
        if (empty($uri->getPath())) {
            throw new InvalidArgumentException("Path must not be empty. A FHIR resource is part of the URIs path.");
        }

        if ("/" === $uri->getPath()) {
            throw new InvalidArgumentException("Path must not be empty. A FHIR resource is part of the URIs path.");
        }
    }

    /**
     * Validates the accept header exists
     * @param  RequestInterface $request the psr7 request to validate
     * @return void
     * @throws \InvalidArgumentException
     * @todo consider validating specific accept e.g. application/json;application/fhir+json
     */
    protected function validatesAcceptHeader(RequestInterface $request)
    {
        if (empty($request->getHeader('accept'))) {
            throw new InvalidArgumentException("Missing header accept");
        }
    }

    /**
     * Validates the content-type header exists
     * @param  RequestInterface $request the psr7 request to validate
     * @return void
     * @throws \InvalidArgumentException
     * @todo consider validating specific content-type e.g. application/json;application/fhir+json
     */
    protected function validatesContentTypeHeader(RequestInterface $request)
    {
        if (empty($request->getHeader('content-type')) && ($request->getMethod() === 'POST' || $request->getMethod() === 'PUT')) {
            throw new InvalidArgumentException("Missing header content-type");
        }
    }

    /**
     * Validates the authorization header exists. This is necessary
     * For all requests to the resources defined by this contract.
     *
     * @param  RequestInterface $request the psr7 request to validate
     * @return void
     * @throws \InvalidArgumentException
     */
    protected function validatesAuthorizationHeader(RequestInterface $request)
    {
        if (empty($request->getHeader('authorization'))) {
            throw new InvalidArgumentException("Missing header authorization");
        }

        $header = $request->getHeader('authorization')[0];

        // covers Bearer with at least one trailing space
        if (0 !== strpos($header, 'Bearer ')) {
            throw new InvalidArgumentException("Bearer token must be RFC 6750 compatible string");
        }

        $segments = explode(' ', $header);

        if (2 !== count($segments)) {
            throw new InvalidArgumentException("Bearer token must be RFC 6750 compatible string");
        }
    }

    /**
     * Standardized methods that are commonly used in HTTP by convention,
     * Standardized methods are defined in all-uppercase US-ASCII letters.
     * https://tools.ietf.org/html/rfc7231#section-4.1
     * @param  RequestInterface $request [description]
     * @return void
     */
    protected function validateStandardizedHttpMethod(RequestInterface $request)
    {
        if (! in_array($request->getMethod(), ['GET', 'HEAD', 'POST', 'PUT', 'DELETE', 'CONNECT', 'OPTIONS', 'TRACE'])) {
            throw new InvalidArgumentException("HTTP method must be standardized RFC 7231 compliant. See section 4.1.");
        }
    }

    protected function validatesRequiredHeaders(RequestInterface $request)
    {
        $this->validatesAcceptHeader($request);

        $this->validateStandardizedHttpMethod($request);

        $this->validatesContentTypeHeader($request);

        $this->validatesAuthorizationHeader($request);
    }
}
