<?php
/**
 * Code Samples.
 *
 * @author Krzysztof Kardasz <krzysztof@kardasz.eu>
 * @license MIT
 */
namespace Kardasz\Tests\Service\Map\ObjectDetails\Visitor;

use DateTime;
use Exception;
use Kardasz\DTO\MapObjectDetailsDTO;
use Kardasz\Service\Map\ObjectDetails\Visitor\Workstart;
use PHPUnit\Framework\TestCase;

/**
 * Class WorkStartTest.
 */
class WorkStartTest extends TestCase
{
    /**
     * @dataProvider dataProvider
     * @covers       \Workstart::visit
     *
     * @param DateTime|null $expected
     * @param array|null    $data
     *
     * @throws Exception
     */
    public function testVisit(?DateTime $expected, ?array $data = null)
    {
        $dto = new MapObjectDetailsDTO();

        $subject = new Workstart();
        $subject->visit($dto, $data);

        $this->assertEquals($expected, $dto->getWorkstart());
    }

    /**
     * @return array
     *
     * @throws Exception
     */
    public function dataProvider(): array
    {
        return [
            [
                new DateTime('2018-10-01 08:15:00'),
                [
                    'summary' => [
                        'workstart' => strtotime('2018-10-01 08:15:00'),
                    ],
                ],
            ],
            [
                new DateTime('2018-12-01 08:32:12'),
                [
                    'summary' => [
                        'workstart' => strtotime('2018-12-01 08:32:12'),
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
