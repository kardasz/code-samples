<?php
/**
 * Code Samples
 * @author Krzysztof Kardasz <krzysztof@kardasz.eu>
 * @license MIT
 */

namespace Kardasz\Tests\Service\Map\ObjectDetails\Visitor;

use Kardasz\DTO\MapObjectDetailsDTO;
use Kardasz\Service\Map\ObjectDetails\Visitor\ParkStopTime;
use PHPUnit\Framework\TestCase;

/**
 * Class ParkStopTimeTest
 * @package Kardasz\Tests\Service\Map\ObjectDetails\Visitor
 */
class ParkStopTimeTest extends TestCase
{
    /**
     * @dataProvider dataProvider
     * @covers       ParkStopTime::visit
     *
     * @param int|null   $expectedTime
     * @param int|null   $expectedHours
     * @param int|null   $expectedMinutes
     * @param array|null $data
     */
    public function testVisit(?int $expectedTime, ?int $expectedHours, ?int $expectedMinutes, ?array $data = null)
    {
        $dto = new MapObjectDetailsDTO();

        $subject = new ParkStopTime();
        $subject->visit($dto, $data);

        $this->assertEquals($expectedTime, $dto->getParkStopTime());
        $this->assertEquals($expectedHours, $dto->getParkStopHours());
        $this->assertEquals($expectedMinutes, $dto->getParkStopMinutes());
    }

    /**
     * @return array
     */
    public function dataProvider(): array
    {
        return [
            [
                3600 + (60 * 45) + 12,
                1,
                45,
                [
                    'summary' => [
                        'parkstop' => 3600 + (60 * 45) + 12
                    ]
                ]
            ],
            [
                (3 * 3600) + (60 * 21) + 12,
                3,
                21,
                [
                    'summary' => [
                        'parkstop' => (3 * 3600) + (60 * 21) + 12
                    ]
                ]
            ],
            [
                null,
                0,
                0,
                [
                    'summary' => [
                        'parkstop' => null
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
                        'parkstop' => 'abc'
                    ]
                ]
            ],

        ];
    }
}
