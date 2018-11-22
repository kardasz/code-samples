<?php
/**
 * Code Samples
 * @author Krzysztof Kardasz <krzysztof@kardasz.eu>
 * @license MIT
 */

namespace Kardasz\Tests\Service\Map\ObjectDetails\Visitor;

use Kardasz\DTO\MapObjectDetailsDTO;
use Kardasz\Service\Map\ObjectDetails\Visitor\ParkTime300;
use PHPUnit\Framework\TestCase;

/**
 * Class ParkTime300Test
 * @package Kardasz\Tests\Service\Map\ObjectDetails\Visitor
 */
class ParkTime300Test extends TestCase
{
    /**
     * @dataProvider dataProvider
     * @covers       ParkTime300::visit
     *
     * @param int|null   $expectedTime
     * @param int|null   $expectedHours
     * @param int|null   $expectedMinutes
     * @param array|null $data
     */
    public function testVisit(?int $expectedTime, ?int $expectedHours, ?int $expectedMinutes, ?array $data = null)
    {
        $dto = new MapObjectDetailsDTO();

        $subject = new ParkTime300();
        $subject->visit($dto, $data);

        $this->assertEquals($expectedTime, $dto->getParkTime300());
        $this->assertEquals($expectedHours, $dto->getParkTime300Hours());
        $this->assertEquals($expectedMinutes, $dto->getParkTime300Minutes());
    }

    /**
     * @return array
     */
    public function dataProvider(): array
    {
        return [
            [
                3600 + (60 * 47) + 6,
                1,
                47,
                [
                    'summary' => [
                        'parktime_300' => 3600 + (60 * 47) + 6
                    ]
                ]
            ],
            [
                (5 * 3600) + (60 * 12) + 6,
                5,
                12,
                [
                    'summary' => [
                        'parktime_300' => (5 * 3600) + (60 * 12) + 6
                    ]
                ]
            ],
            [
                null,
                0,
                0,
                [
                    'summary' => [
                        'parktime_300' => null
                    ]
                ]
            ],
            [
                null,
                0,
                0,
                [
                    'summary' => []
                ]
            ],
            [
                0,
                0,
                0,
                [
                    'summary' => [
                        'parktime_300' => 'abc'
                    ]
                ]
            ],

        ];
    }
}
