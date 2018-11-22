<?php
/**
 * Code Samples.
 *
 * @author Krzysztof Kardasz <krzysztof@kardasz.eu>
 * @license MIT
 */
namespace Kardasz\Tests\Service\Map\ObjectSummary\Visitor;

use Kardasz\DTO\MapObjectSummaryDTO;
use Kardasz\Service\Map\ObjectSummary\Visitor\Geo2;
use PHPUnit\Framework\TestCase;

/**
 * Class Geo2Test.
 */
class Geo2Test extends TestCase
{
    /**
     * @dataProvider dataProvider
     * @covers       \Geo2::visit
     *
     * @param float|null $expectedLat
     * @param float|null $expectedLng
     * @param array|null $data
     */
    public function testVisit(?float $expectedLat, ?float $expectedLng, ?array $data = null)
    {
        $dto = new MapObjectSummaryDTO();
        $subject = new Geo2();
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
                        'record_additional_data' => [
                            'GpsLatitude' => 52.411537,
                            'GpsLongitude' => 16.936883,
                        ],
                    ],
                ],
            ],
            [
                52.581537,
                null,
                [
                    'last_record' => [
                        'record_additional_data' => [
                            'GpsLatitude' => 52.581537,
                        ],
                    ],
                ],
            ],
            [
                null,
                16.776883,
                [
                    'last_record' => [
                        'record_additional_data' => [
                            'GpsLongitude' => 16.776883,
                        ],
                    ],
                ],
            ],
            [
                null,
                null,
                [
                    'last_record' => [
                        'record_additional_data' => [
                            'GpsLatitude' => null,
                            'GpsLongitude' => null,
                        ],
                    ],
                ],
            ],
            [
                null,
                null,
                [],
            ],
            [
                null,
                null,
                null,
            ],
        ];
    }
}
