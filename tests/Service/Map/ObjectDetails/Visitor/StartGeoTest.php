<?php
/**
 * Code Samples
 * @author Krzysztof Kardasz <krzysztof@kardasz.eu>
 * @license MIT
 */

namespace Kardasz\Tests\Service\Map\ObjectDetails\Visitor;

use Kardasz\DTO\MapObjectDetailsDTO;
use Kardasz\Service\Map\ObjectDetails\Visitor\StartGeo;
use PHPUnit\Framework\TestCase;

/**
 * Class StartGeoTest
 * @package Kardasz\Tests\Service\Map\ObjectDetails\Visitor
 */
class StartGeoTest extends TestCase
{
    /**
     * @dataProvider dataProvider
     * @covers       StartGeo::visit
     *
     * @param float|null $expectedLat
     * @param float|null $expectedLng
     * @param array|null $data
     */
    public function testVisit(?float $expectedLat, ?float $expectedLng, ?array $data = null)
    {
        $dto = new MapObjectDetailsDTO();

        $subject = new StartGeo();
        $subject->visit($dto, $data);

        $this->assertEquals($expectedLat, $dto->getStartLat());
        $this->assertEquals($expectedLng, $dto->getStartLng());
    }

    /**
     * @return array
     */
    public function dataProvider(): array
    {
        return [
            [
                52.411537,
                16.936883,
                [
                    'summary' => [
                        'posstart' => [
                            'record_gps_latitude' => 52.411537,
                            'record_gps_longitude' => 16.936883,
                        ]
                    ]
                ]
            ],
            [
                52.111537,
                16.236883,
                [
                    'summary' => [
                        'posstart' => [
                            'record_gps_latitude' => 52.111537,
                            'record_gps_longitude' => 16.236883,
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
