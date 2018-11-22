<?php
/**
 * Code Samples
 * @author Krzysztof Kardasz <krzysztof@kardasz.eu>
 * @license MIT
 */

namespace Kardasz\Tests\Service\Map\ObjectSummary\Visitor;

use Kardasz\DTO\MapObjectSummaryDTO;
use Kardasz\Service\Map\ObjectSummary\Visitor\Acc;
use PHPUnit\Framework\TestCase;

/**
 * Class AccTest
 * @package Kardasz\Tests\Service\Map\ObjectSummary\Visitor
 */
class AccTest extends TestCase
{
    /**
     * @dataProvider dataProvider
     * @covers       Acc::visit
     *
     * @param string|null $expected
     * @param array|null  $data
     */
    public function testVisit(?string $expected, ?array $data = null)
    {
        $dto = new MapObjectSummaryDTO();
        $subject = new Acc();
        $subject->visit($dto, $data);

        $this->assertEquals($expected, $dto->getAcc());
    }

    /**
     * @return array
     */
    public function dataProvider(): array
    {
        return [
            [
                '123.112',
                [
                    'last_record' => [
                        'record_additional_data' => [
                            'SensorAcc' => '123.112'
                        ]
                    ]
                ]
            ],
            [
                '4123.11 foo',
                [
                    'last_record' => [
                        'record_additional_data' => [
                            'SensorAcc' => '4123.11 foo'
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
        ];
    }
}
