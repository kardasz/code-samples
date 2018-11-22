<?php
/**
 * Code Samples.
 *
 * @author Krzysztof Kardasz <krzysztof@kardasz.eu>
 * @license MIT
 */
namespace Kardasz\Tests\Service\Map\ObjectSummary\Visitor;

use Kardasz\DTO\MapObjectSummaryDTO;
use Kardasz\Service\Map\ObjectSummary\Visitor\VisitorChain;
use Kardasz\Service\Map\ObjectSummary\Visitor\VisitorInterface;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;

/**
 * Class VisitorChainTest.
 */
class VisitorChainTest extends TestCase
{
    /**
     * @covers \VisitorChain::add
     * @covers \VisitorChain::visit
     */
    public function testVisit()
    {
        $dto = new MapObjectSummaryDTO();
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
