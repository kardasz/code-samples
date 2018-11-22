<?php
/**
 * Code Samples.
 *
 * @author Krzysztof Kardasz <krzysztof@kardasz.eu>
 * @license MIT
 */
namespace Kardasz\Tests\Service\Map\ObjectSummary\Visitor;

use Kardasz\DTO\MapObjectSummaryDTO;
use Kardasz\Service\Map\ObjectSummary\Visitor\Rpm;
use PHPUnit\Framework\TestCase;

/**
 * Class RpmTest.
 */
class RpmTest extends TestCase
{
    /**
     * @dataProvider dataProvider
     * @covers       \Acc::visit
     *
     * @param int|null   $expected
     * @param array|null $data
     */
    public function testVisit(?int $expected, ?array $data = null)
    {
        $dto = new MapObjectSummaryDTO();
        $subject = new Rpm();
        $subject->visit($dto, $data);

        $this->assertEquals($expected, $dto->getRpm());
    }

    /**
     * @return array
     */
    public function dataProvider(): array
    {
        return [
            [
                2700,
                [
                    'last_record' => [
                        'record_rpm' => 2700,
                    ],
                ],
            ],
            [
                3786,
                [
                    'last_record' => [
                        'record_rpm' => 3786,
                    ],
                ],
            ],
            [
                null,
                [
                    'last_record' => [
                        'record_rpm' => null,
                    ],
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
