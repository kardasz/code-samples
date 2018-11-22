<?php
/**
 * Code Samples
 * @author Krzysztof Kardasz <krzysztof@kardasz.eu>
 * @license MIT
 */

namespace Kardasz\Tests\Service\Map\ObjectDetails\Visitor;

use Kardasz\DTO\MapObjectDetailsDTO;
use Kardasz\Service\Map\ObjectDetails\Visitor\ParkTime;
use PHPUnit\Framework\TestCase;

/**
 * Class ParkTimeTest
 * @package Kardasz\Tests\Service\Map\ObjectDetails\Visitor
 */
class ParkTimeTest extends TestCase
{
    /**
     * @dataProvider dataProvider
     * @covers       ParkTime::visit
     *
     * @param int|null   $expectedTime
     * @param int|null   $expectedHours
     * @param int|null   $expectedMinutes
     * @param array|null $data
     */
    public function testVisit(?int $expectedTime, ?int $expectedHours, ?int $expectedMinutes, ?array $data = null)
    {
        $dto = new MapObjectDetailsDTO();

        $subject = new ParkTime();
        $subject->visit($dto, $data);

        $this->assertEquals($expectedTime, $dto->getParkTime());
        $this->assertEquals($expectedHours, $dto->getParkHours());
        $this->assertEquals($expectedMinutes, $dto->getParkMinutes());
    }

    /**
     * @return array
     */
    public function dataProvider(): array
    {
        return [
            [
                3600 + (60 * 15) + 12,
                1,
                15,
                [
                    'summary' => [
                        'parktime' => 3600 + (60 * 15) + 12
                    ]
                ]
            ],
            [
                (3 * 3600) + (60 * 35) + 12,
                3,
                35,
                [
                    'summary' => [
                        'parktime' => (3 * 3600) + (60 * 35) + 12
                    ]
                ]
            ],
            [
                null,
                0,
                0,
                [
                    'summary' => [
                        'parktime' => null
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
                        'parktime' => 'abc'
                    ]
                ]
            ],

        ];
    }
}
