<?php
/**
 * Code Samples
 * @author Krzysztof Kardasz <krzysztof@kardasz.eu>
 * @license MIT
 */

namespace Kardasz\Tests\Service\Map\ObjectSummary\Visitor;

use Kardasz\DTO\MapObjectSummaryDTO;
use Kardasz\Service\Map\ObjectSummary\Visitor\Description;
use PHPUnit\Framework\TestCase;

/**
 * Class DescriptionTest
 * @package Kardasz\Tests\Service\Map\ObjectSummary\Visitor
 */
class DescriptionTest extends TestCase
{
    /**
     * @dataProvider dataProvider
     * @covers       Description::visit
     *
     * @param string|null $expected
     * @param array|null  $data
     */
    public function testVisit(?string $expected, ?array $data = null)
    {
        $dto = new MapObjectSummaryDTO();
        $subject = new Description();
        $subject->visit($dto, $data);

        $this->assertEquals($expected, $dto->getDescription());
    }

    /**
     * @return array
     */
    public function dataProvider(): array
    {
        return [
            [
                'Skoda Octavia, 1, 2009',
                [
                    'object_description' => 'Skoda Octavia, 1, 2009'
                ]
            ],
            [
                'Skoda Rapid, 3, 2018',
                [
                    'object_description' => 'Skoda Rapid, 3, 2018'
                ]
            ],
            [
                null,
                [
                    'object_description' => null
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
