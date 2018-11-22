<?php
/**
 * Code Samples.
 *
 * @author Krzysztof Kardasz <krzysztof@kardasz.eu>
 * @license MIT
 */
namespace Kardasz\Tests\Service\Map\ObjectSummary\Visitor;

use Kardasz\DTO\MapObjectSummaryDTO;
use Kardasz\Service\Map\ObjectSummary\Visitor\RideType;
use PHPUnit\Framework\TestCase;

/**
 * Class RideTypeTest.
 */
class RideTypeTest extends TestCase
{
    /**
     * @dataProvider dataProvider
     * @covers       \RideType::visit
     *
     * @param string|null $expected
     * @param array|null  $data
     */
    public function testVisit(?string $expected, ?array $data)
    {
        $dto = new MapObjectSummaryDTO();
        $subject = new RideType();
        $subject->visit($dto, $data);

        $this->assertEquals($expected, $dto->getRideType());
    }

    /**
     * @return array
     */
    public function dataProvider(): array
    {
        return [
            [
                RideType::TYPE_PRIVATE,
                [
                    'last_record' => [
                        'record_device_state' => 32 | 16,
                    ],
                ],
            ],
            [
                RideType::TYPE_PRIVATE,
                [
                    'last_record' => [
                        'record_device_state' => 128 | 8 | 16,
                    ],
                ],
            ],
            [
                RideType::TYPE_BUSINESS,
                [
                    'last_record' => [
                        'record_device_state' => 128 | 8 | 32,
                    ],
                ],
            ],
            [
                null,
                [
                    'last_record' => [],
                ],
            ],
        ];
    }
}
