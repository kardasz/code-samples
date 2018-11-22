<?php
/**
 * Code Samples
 * @author Krzysztof Kardasz <krzysztof@kardasz.eu>
 * @license MIT
 */

namespace Kardasz\Tests\Service\Map\ObjectDetails\Visitor;

use Kardasz\DTO\MapObjectDetailsDTO;
use Kardasz\Service\Map\ObjectDetails\Visitor\Odometer;
use PHPUnit\Framework\TestCase;

/**
 * Class OdometerTest
 * @package Kardasz\Tests\Service\Map\ObjectDetails\Visitor
 */
class OdometerTest extends TestCase
{
    /**
     * @dataProvider dataProvider
     * @covers       Odometer::visit
     *
     * @param int|null   $expected
     * @param array|null $data
     */
    public function testVisit(?int $expected, ?array $data = null)
    {
        $dto = new MapObjectDetailsDTO();

        $subject = new Odometer();
        $subject->visit($dto, $data);

        $this->assertEquals($expected, $dto->getOdometer());
    }

    /**
     * @return array
     */
    public function dataProvider(): array
    {
        return [
            [
                789,
                [
                    'summary' => [
                        'last_odo' => 789
                    ]
                ]
            ],
            [
                2341,
                [
                    'summary' => [
                        'last_odo' => 2341
                    ]
                ]
            ],
            [
                null,
                [
                    'summary' => [
                        'last_odo' => null
                    ]
                ]
            ],
            [
                null,
                [
                    'summary' => []
                ]
            ],
            [
                0,
                [
                    'summary' => [
                        'last_odo' => 'abc'
                    ]
                ]
            ],

        ];
    }
}
