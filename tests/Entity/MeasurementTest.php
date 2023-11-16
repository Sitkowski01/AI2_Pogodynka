<?php

namespace App\Tests\Entity;

use App\Entity\Measurement;
use PHPUnit\Framework\TestCase;

class MeasurementTest extends TestCase
{
    public function dataGetFahrenheit(): array
    {
        return [
            ['0', 32],
            ['-100', -148],
            ['100', 212],
            ['0.5', 32.9],
            ['-17.6', 0.32],
            ['37', 98.6],
            ['25', 77],
            ['-40', -40],
            ['10', 50],
            ['-20.5', -4.9],
        ];
    }


    /**
     * @dataProvider dataGetFahrenheit
     */
    public function testGetFahrenheit($celsius, $expectedFahrenheit): void
    {
        $measurement = new Measurement();
        $measurement->setCelsius($celsius);
        $this->assertEquals($expectedFahrenheit, $measurement->getFahrehneit(), "Expected $expectedFahrenheit Fahrenheit for $celsius Celsius, got {$measurement->getFahrehneit()}");
    }

}
