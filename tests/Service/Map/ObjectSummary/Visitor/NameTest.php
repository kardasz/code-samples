<?php
/**
 * Code Samples.
 *
 * @author Krzysztof Kardasz <krzysztof@kardasz.eu>
 * @license MIT
 */
namespace Kardasz\Tests\Service\Map\ObjectSummary\Visitor;

use Kardasz\DTO\MapObjectSummaryDTO;
use Kardasz\Service\Map\ObjectSummary\Visitor\Name;
use PHPUnit\Framework\TestCase;

/**
 * Class NameTest.
 */
class NameTest extends TestCase
{
    /**
     * @dataProvider dataProvider
     * @covers       \Name::visit
     *
     * @param string|null $expected
     * @param array|null  $data
     */
    public function testVisit(?string $expected, ?array $data = null)
    {
        $dto = new MapObjectSummaryDTO();
        $subject = new Name();
        $subject->visit($dto, $data);

        $this->assertEquals($expected, $dto->getName());
    }

    /**
     * @return array
     */
    public function dataProvider(): array
    {
        return [
            [
                'WU13523',
                [
                    'object_name' => 'WU13523',
                ],
            ],
            [
                'DW13523',
                [
                    'object_name' => 'DW13523',
                ],
            ],
            [
                null,
                [
                    'object_name' => null,
                ],
            ],
            [
                null,
                [],
            ],
            [
                null,
                null,
            ],
        ];
    }
}
