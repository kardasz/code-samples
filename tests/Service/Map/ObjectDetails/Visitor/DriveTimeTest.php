<?php
/**
 * Code Samples.
 *
 * @author Krzysztof Kardasz <krzysztof@kardasz.eu>
 * @license MIT
 */
namespace Kardasz\Tests\Service\Map\ObjectDetails\Visitor;

use Kardasz\DTO\MapObjectDetailsDTO;
use Kardasz\Service\Map\ObjectDetails\Visitor\DriveTime;
use PHPUnit\Framework\TestCase;

/**
 * Class DriveTimeTest.
 */
class DriveTimeTest extends TestCase
{
    /**
     * @dataProvider dataProvider
     * @covers       \DriveTime::visit
     *
     * @param int|null   $expected
     * @param array|null $data
     */
    public function testVisit(?int $expected, ?array $data = null)
    {
        $dto = new MapObjectDetailsDTO();

        $subject = new DriveTime();
        $subject->visit($dto, $data);

        $this->assertEquals($expected, $dto->getDriveTime());
    }

    /**
     * @return array
     */
    public function dataProvider(): array
    {
        return [
            [
                3600,
                [
                    'summary' => [
                        'drivetime' => 3600,
                    ],
                ],
            ],
            [
                3345,
                [
                    'summary' => [
                        'drivetime' => 3345,
                    ],
                ],
            ],
            [
                null,
                [
                    'summary' => [],
                ],
            ],
        ];
    }
}
