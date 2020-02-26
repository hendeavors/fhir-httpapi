<?php

declare(strict_types=1);

namespace Endeavors\Fhir\Http\Api\Four\Facade;

use Endeavors\Fhir\Http\Api\Four\Clinical as ClinicalRoot;
use Endeavors\Fhir\Http\Api\Support\Resolver;

class Clinical
{
    use Resolver;
    // TODO: set argument maximum
    public static function __callStatic($method, $args)
    {
        $request = static::resolvePsr7Request($method, $args);

        unset($args[array_search($request, $args)]);

        $client = static::resolvePsr18HttpClient($method, $args);

        unset($args[array_search($client, $args)]);

        return (new ClinicalRoot($client, ...$args))->$method($request);
    }
}
