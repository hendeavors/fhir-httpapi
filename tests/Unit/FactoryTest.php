<?php

namespace Endeavors\Fhir\Http\Api\Tests\Unit;

use LogicException;
use ReflectionClass;
use PHPUnit\Framework\TestCase;
use Endeavors\Fhir\Http\Api\Four\Factory;

class FactoryTest extends TestCase
{
    protected function setUp() : void
    {
        $reflectionClass = new ReflectionClass(Factory::class);
        $reflectionProperty = $reflectionClass->getProperty('instance');
        $reflectionProperty->setAccessible(true);
        $reflectionProperty->setValue(null);
    }
    
    /**
     * @test
     */
    public function failsInstanceCreation()
    {
        $this->expectException(LogicException::class);

        $instance = Factory::getInstance();
    }
}
