<?php
/**
 * Code Samples
 * @author Krzysztof Kardasz <krzysztof@kardasz.eu>
 * @license MIT
 */

namespace Kardasz\Tests\Service\Map\ObjectDetails\Visitor;

use Kardasz\DTO\MapObjectDetailsDTO;
use Kardasz\Service\Map\ObjectDetails\Visitor\ParkTime300Count;
use PHPUnit\Framework\TestCase;

/**
 * Class ParkTime300CountTest
 * @package Kardasz\Tests\Service\Map\ObjectDetails\Visitor
 */
class ParkTime300CountTest extends TestCase
{
    /**
     * @dataProvider dataProvider
     * @covers       ParkTime300Count::visit
     *
     * @param int|null   $expected
     * @param array|null $data
     */
    public function testVisit(?int $expected, ?array $data = null)
    {
        $dto = new MapObjectDetailsDTO();

        $subject = new ParkTime300Count();
        $subject->visit($dto, $data);

        $this->assertEquals($expected, $dto->getParkTime300Count());
    }

    /**
     * @return array
     */
    public function dataProvider(): array
    {
        return [
            [
                6,
                [
                    'summary' => [
                        'parktime_300_count' => 6
                    ]
                ]
            ],
            [
                2,
                [
                    'summary' => [
                        'parktime_300_count' => 2
                    ]
                ]
            ],
            [
                null,
                [
                    'summary' => [
                        'parktime_300_count' => null
                    ]
                ]
            ],
            [
                0,
                [
                    'summary' => [
                        'parktime_300_count' => 'xyz'
                    ]
                ]
            ],

        ];
    }
}
