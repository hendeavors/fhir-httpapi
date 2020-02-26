<?php

declare(strict_types=1);

namespace Endeavors\Fhir\Http\Api\Support;

use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use InvalidArgumentException;

trait Resolver
{
    public static function resolvePsr7Request($method, $args): RequestInterface
    {
        $request = null;

        foreach ((array)$args as $arg) {
            if ($arg instanceof RequestInterface) {
                $request = $arg;
            }
        }

        // TODO: if the request is still null consider defaulting a request implementation
        // Check for a standardized http method, next validate that a URI exists

        static::guard($request, "A Psr7 compatible request is required.");

        return $request;
    }

    public static function resolvePsr18HttpClient($method, $args): ClientInterface
    {
        $client = null;

        foreach ((array)$args as $arg) {
            if ($arg instanceof ClientInterface) {
                $client = $arg;
            }
        }

        static::guard($client, "A Psr18 compatible Http Client is required.");

        return $client;
    }

    public static function guard($value, string $message)
    {
        if (null === $value) {
            throw new InvalidArgumentException($message);
        }
    }
}
