<?php

namespace Endeavors\Fhir\Http\Api\Four\Facade;

use Endeavors\Fhir\Http\Api\Four\Clinical as ClinicalRoot;
use Endeavors\Fhir\Http\Api\Support\Resolver;

class Clinical
{
    use Resolver;

    public static function __callStatic($method, $args)
    {
        $request = static::resolvePsr7Request($method, $args);

        $client = static::resolvePsr18HttpClient($method, $args);

        return (new ClinicalRoot($client))->$method($request);
    }
}
