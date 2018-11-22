<?php
/**
 * Code Samples
 * @author Krzysztof Kardasz <krzysztof@kardasz.eu>
 * @license MIT
 */

namespace Kardasz\Tests\Service\Map\ObjectDetails\Visitor;

use Kardasz\DTO\MapObjectDetailsDTO;
use Kardasz\Service\Map\ObjectDetails\Visitor\VisitorChain;
use Kardasz\Service\Map\ObjectDetails\Visitor\VisitorInterface;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;

/**
 * Class VisitorChainTest
 * @package Kardasz\Tests\Service\Map\ObjectDetails\Visitor
 */
class VisitorChainTest extends TestCase
{
    /**
     * @covers VisitorChain::add
     * @covers VisitorChain::visit
     */
    public function testVisit()
    {
        $dto = new MapObjectDetailsDTO();
        $data = ['foo' => 5];

        $visitor = $this->getVisitorMock();
        $visitor
            ->expects($this->once())
            ->method('visit')
            ->with($dto, $data);

        $subject = new VisitorChain();
        $subject->add($visitor);
        $subject->visit($dto, $data);
    }

    /**
     * @return MockObject|VisitorInterface
     */
    private function getVisitorMock(): VisitorInterface
    {
        return $this->getMockBuilder(VisitorInterface::class)
            ->disableOriginalConstructor()
            ->getMock();
    }
}
