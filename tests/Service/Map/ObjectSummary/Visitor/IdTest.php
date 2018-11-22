<?php
/**
 * Code Samples
 * @author Krzysztof Kardasz <krzysztof@kardasz.eu>
 * @license MIT
 */

namespace Kardasz\Tests\Service\Map\ObjectSummary\Visitor;

use Kardasz\DTO\MapObjectSummaryDTO;
use Kardasz\Service\Map\ObjectSummary\Visitor\Id;
use PHPUnit\Framework\TestCase;

/**
 * Class IdTest
 * @package Kardasz\Tests\Service\Map\ObjectSummary\Visitor
 */
class IdTest extends TestCase
{
    /**
     * @dataProvider dataProvider
     * @covers       Id::visit
     *
     * @param int|null   $expected
     * @param array|null $data
     */
    public function testVisit(?int $expected, ?array $data = null)
    {
        $dto = new MapObjectSummaryDTO();
        $subject = new Id();
        $subject->visit($dto, $data);

        $this->assertEquals($expected, $dto->getId());
    }

    /**
     * @return array
     */
    public function dataProvider(): array
    {
        return [
            [
                55,
                [
                    'object_id' => 55
                ]
            ],
            [
                4323,
                [
                    'object_id' => 4323
                ]
            ],
            [
                null,
                [
                    'object_id' => null
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
