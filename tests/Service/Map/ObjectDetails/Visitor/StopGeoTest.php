<?php
/**
 * Code Samples
 * @author Krzysztof Kardasz <krzysztof@kardasz.eu>
 * @license MIT
 */

namespace Kardasz\Tests\Service\Map\ObjectDetails\Visitor;

use Kardasz\DTO\MapObjectDetailsDTO;
use Kardasz\Service\Map\ObjectDetails\Visitor\StopGeo;
use PHPUnit\Framework\TestCase;

/**
 * Class StopGeoTest
 * @package Kardasz\Tests\Service\Map\ObjectDetails\Visitor
 */
class StopGeoTest extends TestCase
{
    /**
     * @dataProvider dataProvider
     * @covers       StopGeo::visit
     *
     * @param float|null $expectedLat
     * @param float|null $expectedLng
     * @param array|null $data
     */
    public function testVisit(?float $expectedLat, ?float $expectedLng, ?array $data = null)
    {
        $dto = new MapObjectDetailsDTO();

        $subject = new StopGeo();
        $subject->visit($dto, $data);

        $this->assertEquals($expectedLat, $dto->getStopLat());
        $this->assertEquals($expectedLng, $dto->getStopLng());
    }

    /**
     * @return array
     */
    public function dataProvider(): array
    {
        return [
            [
                52.321537,
                16.876883,
                [
                    'summary' => [
                        'posstop' => [
                            'record_gps_latitude' => 52.321537,
                            'record_gps_longitude' => 16.876883,
                        ]
                    ]
                ]
            ],
            [
                52.521537,
                16.416883,
                [
                    'summary' => [
                        'posstop' => [
                            'record_gps_latitude' => 52.521537,
                            'record_gps_longitude' => 16.416883,
                        ]
                    ]
                ]
            ],
            [
                null,
                null,
                [
                    'summary' => [
                        'posstart' => []
                    ]
                ]
            ],
        ];
    }
}
