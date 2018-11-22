<?php
/**
 * Code Samples.
 *
 * @author Krzysztof Kardasz <krzysztof@kardasz.eu>
 * @license MIT
 */
namespace Kardasz\Tests\Service\Map\ObjectSummary\Visitor;

use Kardasz\DTO\MapObjectSummaryDTO;
use Kardasz\Service\Map\ObjectSummary\Visitor\Fuel;
use PHPUnit\Framework\TestCase;

/**
 * Class FuelTest.
 */
class FuelTest extends TestCase
{
    /**
     * @dataProvider dataProvider
     * @covers       \Fuel::visit
     *
     * @param float|null $expected
     * @param array|null $data
     */
    public function testVisit(?float $expected, ?array $data = null)
    {
        $dto = new MapObjectSummaryDTO();
        $subject = new Fuel();
        $subject->visit($dto, $data);

        $this->assertEquals($expected, $dto->getFuel());
    }

    /**
     * @return array
     */
    public function dataProvider(): array
    {
        return [
            [
                32.5,
                [
                    'object_fuel' => 32.5,
                ],
            ],
            [
                42.5,
                [
                    'object_fuel' => 42.5,
                ],
            ],
            [
                null,
                [
                    'object_fuel' => null,
                ],
            ],
            [
                null,
                [],
            ],
            [
                null,
                null,
            ],
        ];
    }
}
