<?php
/**
 * Code Samples
 * @author Krzysztof Kardasz <krzysztof@kardasz.eu>
 * @license MIT
 */

namespace Kardasz\Tests\Service\Map\ObjectDetails\Visitor;

use Kardasz\DTO\MapObjectDetailsDTO;
use Kardasz\Service\Map\ObjectDetails\Visitor\Distance;
use PHPUnit\Framework\TestCase;

/**
 * Class DistanceTest
 * @package Kardasz\Tests\Service\Map\ObjectDetails\Visitor
 */
class DistanceTest extends TestCase
{
    /**
     * @dataProvider dataProvider
     * @covers       Distance::visit
     *
     * @param float      $expected
     * @param array|null $data
     */
    public function testVisit(float $expected, ?array $data = null)
    {
        $dto = new MapObjectDetailsDTO();

        $subject = new Distance();
        $subject->visit($dto, $data);

        $this->assertEquals($expected, $dto->getDistance());
    }

    /**
     * @return array
     */
    public function dataProvider(): array
    {
        return [
            [
                123.55,
                [
                    'summary' => [
                        'distance' => 123.55
                    ]
                ]
            ],
            [
                542.23,
                [
                    'summary' => [
                        'distance' => 542.23
                    ]
                ]
            ],

        ];
    }
}
