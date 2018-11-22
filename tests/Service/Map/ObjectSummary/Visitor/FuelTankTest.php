<?php
/**
 * Code Samples
 * @author Krzysztof Kardasz <krzysztof@kardasz.eu>
 * @license MIT
 */

namespace Kardasz\Tests\Service\Map\ObjectSummary\Visitor;

use Kardasz\DTO\MapObjectSummaryDTO;
use Kardasz\Service\Map\ObjectSummary\Visitor\FuelTank;
use PHPUnit\Framework\TestCase;

/**
 * Class FuelTankTest
 * @package Kardasz\Tests\Service\Map\ObjectSummary\Visitor
 */
class FuelTankTest extends TestCase
{
    /**
     * @dataProvider dataProvider
     * @covers       FuelTank::visit
     *
     * @param float|null $expected
     * @param array|null $data
     */
    public function testVisit(?float $expected, ?array $data = null)
    {
        $dto = new MapObjectSummaryDTO();
        $subject = new FuelTank();
        $subject->visit($dto, $data);

        $this->assertEquals($expected, $dto->getFuelTank());
    }

    /**
     * @return array
     */
    public function dataProvider(): array
    {
        return [
            [
                37,
                [
                    'fuel_tank_1' => 12.5,
                    'fuel_tank_2' => 24.5
                ]
            ],
            [
                42.5,
                [
                    'fuel_tank_1' => 42.5,
                    'fuel_tank_2' => 0
                ]
            ],
            [
                32.1,
                [
                    'fuel_tank_1' => 0,
                    'fuel_tank_2' => 32.1
                ]
            ],
            [
                null,
                [
                    'fuel_tank_1' => null,
                    'fuel_tank_2' => null
                ]
            ],
            [
                null,
                []
            ],
            [
                null,
                null
            ],
        ];
    }
}
