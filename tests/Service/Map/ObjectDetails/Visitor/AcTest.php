<?php
/**
 * Code Samples.
 *
 * @author Krzysztof Kardasz <krzysztof@kardasz.eu>
 * @license MIT
 */
namespace Kardasz\Tests\Service\Map\ObjectDetails\Visitor;

use Kardasz\DTO\MapObjectDetailsDTO;
use Kardasz\Service\Map\ObjectDetails\Visitor\Ac;
use Kardasz\VO\AcVO;
use PHPUnit\Framework\TestCase;

/**
 * Class AcTest.
 */
class AcTest extends TestCase
{
    /**
     * @dataProvider dataProvider
     * @covers       \Ac::visit
     *
     * @param array      $expected
     * @param array|null $data
     */
    public function testVisit(array $expected, ?array $data = null)
    {
        $dto = new MapObjectDetailsDTO();
        $subject = new Ac();
        $subject->visit($dto, $data);

        $this->assertEquals($expected, $dto->getAc());
    }

    /**
     * @return array
     */
    public function dataProvider(): array
    {
        return [
            [
                [
                    new AcVO('foo', 12, AcVO::TYPE_ANALOG),
                ],
                [
                    'lastrec' => [
                        'record_io' => [
                            'analog' => [
                                [12, 'foo'],
                            ],
                        ],
                    ],
                ],
            ],
            [
                [
                    new AcVO('baz', 44, AcVO::TYPE_ANALOG),
                ],
                [
                    'lastrec' => [
                        'record_io' => [
                            'analog' => [
                                [44, 'baz'],
                            ],
                        ],
                    ],
                ],
            ],
            [
                [
                    new AcVO('foo', 4, AcVO::TYPE_ANALOG),
                    new AcVO('baaz', 3, AcVO::TYPE_ANALOG),
                    new AcVO('bar', 45, AcVO::TYPE_TEMP),
                ],
                [
                    'lastrec' => [
                        'record_io' => [
                            'analog' => [
                                [4, 'foo'],
                                [3, 'baaz'],
                            ],
                            'temp' => [
                                [45, 'bar'],
                            ],
                        ],
                    ],
                ],
            ],
        ];
    }
}
