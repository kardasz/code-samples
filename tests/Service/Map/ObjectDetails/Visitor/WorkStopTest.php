<?php
/**
 * Code Samples
 * @author Krzysztof Kardasz <krzysztof@kardasz.eu>
 * @license MIT
 */

namespace Kardasz\Tests\Service\Map\ObjectDetails\Visitor;

use DateTime;
use Exception;
use Kardasz\DTO\MapObjectDetailsDTO;
use Kardasz\Service\Map\ObjectDetails\Visitor\Workstop;
use PHPUnit\Framework\TestCase;

/**
 * Class WorkStopTest
 * @package Kardasz\Tests\Service\Map\ObjectDetails\Visitor
 */
class WorkStopTest extends TestCase
{
    /**
     * @dataProvider dataProvider
     * @covers       Workstop::visit
     *
     * @param DateTime|null $expected
     * @param array|null $data
     * @throws Exception
     */
    public function testVisit(?DateTime $expected, ?array $data = null)
    {
        $dto = new MapObjectDetailsDTO();

        $subject = new Workstop();
        $subject->visit($dto, $data);

        $this->assertEquals($expected, $dto->getWorkstop());
    }

    /**
     * @return array
     * @throws Exception
     */
    public function dataProvider(): array
    {
        return [
            [
                new DateTime('2018-10-12 08:15:00'),
                [
                    'summary' => [
                        'workstop' => strtotime('2018-10-12 08:15:00')
                    ]
                ]
            ],
            [
                new DateTime('2018-03-01 11:45:11'),
                [
                    'summary' => [
                        'workstop' => strtotime('2018-03-01 11:45:11')
                    ]
                ]
            ],
            [
                null,
                [
                    'summary' => []
                ]
            ],
        ];
    }
}
