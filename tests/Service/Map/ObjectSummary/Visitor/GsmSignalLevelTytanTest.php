<?php
/**
 * Code Samples
 * @author Krzysztof Kardasz <krzysztof@kardasz.eu>
 * @license MIT
 */

namespace Kardasz\Tests\Service\Map\ObjectSummary\Visitor;

use Kardasz\DTO\MapObjectSummaryDTO;
use Kardasz\Service\Map\ObjectSummary\Visitor\GsmSignalLevelTytan;
use PHPUnit\Framework\TestCase;

/**
 * Class GsmSignalLevelTytanTest
 * @package Kardasz\Tests\Service\Map\ObjectSummary\Visitor
 */
class GsmSignalLevelTytanTest extends TestCase
{
    /**
     * @dataProvider dataProvider
     * @covers       GsmSignalLevelTytan::visit
     *
     * @param int|null   $expected
     * @param array|null $data
     */
    public function testVisit(?int $expected, ?array $data = null)
    {
        $dto = new MapObjectSummaryDTO();
        $subject = new GsmSignalLevelTytan();
        $subject->visit($dto, $data);

        $this->assertEquals($expected, $dto->getGsmSignalLevel());
    }

    /**
     * @return array
     */
    public function dataProvider(): array
    {
        return [
            [
                50,
                [
                    'last_record' => [
                        'record_additional_data' => [
                            'GsmSignalLevel' => 16,
                        ]
                    ]
                ]
            ],
            [
                100,
                [
                    'last_record' => [
                        'record_additional_data' => [
                            'GsmSignalLevel' => 32,
                        ]
                    ]
                ]
            ],
            [
                0,
                [
                    'last_record' => [
                        'record_additional_data' => [
                            'GsmSignalLevel' => 0,
                        ]
                    ]
                ]
            ],
            [
                null,
                [
                    'last_record' => [
                        'record_additional_data' => []
                    ]
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
