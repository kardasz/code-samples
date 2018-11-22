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
use Kardasz\Service\Map\ObjectDetails\Visitor\Fillings;
use Kardasz\VO\FillingVO;
use PHPUnit\Framework\TestCase;

/**
 * Class FillingsTest
 * @package Kardasz\Tests\Service\Map\ObjectDetails\Visitor
 */
class FillingsTest extends TestCase
{
    /**
     * @dataProvider dataProvider
     * @covers       Fillings::visit
     *
     * @param array      $expected
     * @param array|null $data
     */
    public function testVisit(array $expected, ?array $data = null)
    {
        $dto = new MapObjectDetailsDTO();

        $subject = new Fillings();
        $subject->visit($dto, $data);

        $this->assertEquals($expected, $dto->getFillings());
    }

    /**
     * @return array
     * @throws Exception
     */
    public function dataProvider(): array
    {
        return [
            [
                [
                    new FillingVO(
                        new DateTime('2018-10-01 08:15:00'),
                        42,
                        620
                    )
                ],
                [
                    'fillings' => [
                        [
                            'filling_timestamp' => strtotime('2018-10-01 08:15:00'),
                            'filling_value' => 42,
                            'filling_distance' => 620
                        ]
                    ]
                ]
            ],
            [
                [
                    new FillingVO(
                        new DateTime('2018-10-12 09:23:00'),
                        23,
                        321
                    ),
                    new FillingVO(
                        new DateTime('2018-10-13 19:13:12'),
                        42,
                        525
                    )
                ],
                [
                    'fillings' => [
                        [
                            'filling_timestamp' => strtotime('2018-10-12 09:23:00'),
                            'filling_value' => 23,
                            'filling_distance' => 321
                        ],
                        [
                            'filling_timestamp' => strtotime('2018-10-13 19:13:12'),
                            'filling_value' => 42,
                            'filling_distance' => 525
                        ]
                    ]
                ]
            ],

        ];
    }
}
