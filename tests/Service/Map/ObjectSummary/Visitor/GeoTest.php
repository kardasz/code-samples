<?php
/**
 * Code Samples
 * @author Krzysztof Kardasz <krzysztof@kardasz.eu>
 * @license MIT
 */

namespace Kardasz\Tests\Service\Map\ObjectSummary\Visitor;

use Kardasz\DTO\MapObjectSummaryDTO;
use Kardasz\Service\Map\ObjectSummary\Visitor\Geo;
use PHPUnit\Framework\TestCase;

/**
 * Class GeoTest
 * @package Kardasz\Tests\Service\Map\ObjectSummary\Visitor
 */
class GeoTest extends TestCase
{
    /**
     * @dataProvider dataProvider
     * @covers       Geo::visit
     *
     * @param float|null $expectedLat
     * @param float|null $expectedLng
     * @param array|null $data
     */
    public function testVisit(?float $expectedLat, ?float $expectedLng, ?array $data = null)
    {
        $dto = new MapObjectSummaryDTO();
        $subject = new Geo();
        $subject->visit($dto, $data);

        $this->assertEquals($expectedLat, $dto->getLat());
        $this->assertEquals($expectedLng, $dto->getLng());
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
                    'last_record' => [
                        'record_gps_latitude' => 52.411537,
                        'record_gps_longitude' => 16.936883,
                    ]
                ]
            ],
            [
                52.581537,
                null,
                [
                    'last_record' => [
                        'record_gps_latitude' => 52.581537,
                    ]
                ]
            ],
            [
                null,
                16.776883,
                [
                    'last_record' => [
                        'record_gps_longitude' => 16.776883,
                    ]
                ]
            ],
            [
                null,
                null,
                [
                    'last_record' => [
                        'record_gps_latitude' => null,
                        'record_gps_longitude' => null,
                    ]
                ]
            ],
            [
                null,
                null,
                []
            ],
            [
                null,
                null,
                null
            ],
        ];
    }
}
