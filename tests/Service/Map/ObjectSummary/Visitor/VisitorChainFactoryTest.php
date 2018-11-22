<?php
/**
 * Code Samples
 * @author Krzysztof Kardasz <krzysztof@kardasz.eu>
 * @license MIT
 */

namespace Kardasz\Tests\Service\Map\ObjectSummary\Visitor;

use Psr\Container\ContainerInterface;
use Kardasz\Service\Map\ObjectSummary\Visitor\Acc;
use Kardasz\Service\Map\ObjectSummary\Visitor\Description;
use Kardasz\Service\Map\ObjectSummary\Visitor\Fuel;
use Kardasz\Service\Map\ObjectSummary\Visitor\FuelTank;
use Kardasz\Service\Map\ObjectSummary\Visitor\Geo;
use Kardasz\Service\Map\ObjectSummary\Visitor\Geo2;
use Kardasz\Service\Map\ObjectSummary\Visitor\GsmSignalLevelTytan;
use Kardasz\Service\Map\ObjectSummary\Visitor\Id;
use Kardasz\Service\Map\ObjectSummary\Visitor\Name;
use Kardasz\Service\Map\ObjectSummary\Visitor\RideType;
use Kardasz\Service\Map\ObjectSummary\Visitor\Rpm;
use Kardasz\Service\Map\ObjectSummary\Visitor\VisitorChainFactory;
use Kardasz\Service\Map\ObjectSummary\Visitor\VisitorChainFactoryInterface;
use Kardasz\Service\Map\ObjectSummary\Visitor\VisitorChainInterface;
use Kardasz\Service\Map\ObjectSummary\Visitor\VisitorInterface;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;
use ReflectionClass;

/**
 * Class VisitorChainFactoryTest
 * @package Kardasz\Tests\Service\Map\ObjectSummary\Visitor
 */
class VisitorChainFactoryTest extends TestCase
{
    /**
     * @covers VisitorChainFactory::create
     */
    public function testVisitors()
    {
        $container = $this->getContainerMock();

        $container
            ->expects($this->exactly(11))
            ->method('get')
            ->withConsecutive(
                [Acc::class],
                [Description::class],
                [Fuel::class],
                [FuelTank::class],
                [Geo::class],
                [Geo2::class],
                [GsmSignalLevelTytan::class],
                [Id::class],
                [Name::class],
                [RideType::class],
                [Rpm::class]
            )
            ->willReturn($this->getVisitorMock());

        $subject = new VisitorChainFactory();
        $results = $subject->create($container);

        $this->assertInstanceOf(VisitorChainFactoryInterface::class, $subject);
        $this->assertInstanceOf(VisitorChainInterface::class, $results);
    }

    /**
     * @covers VisitorChainFactory::create
     */
    public function testInvoke()
    {
        $container = $this->getContainerMock();
        $container
            ->expects($this->atLeastOnce())
            ->method('get')
            ->with(
                $this->callback(function ($subject) {
                    return (new ReflectionClass($subject))->implementsInterface(VisitorInterface::class);
                })
            )
            ->willReturn($this->getVisitorMock());

        $subject = new VisitorChainFactory();
        $results = $subject->create($container);

        $this->assertInstanceOf(VisitorChainFactoryInterface::class, $subject);
        $this->assertInstanceOf(VisitorChainInterface::class, $results);
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

    /**
     * @return MockObject|ContainerInterface
     */
    private function getContainerMock(): ContainerInterface
    {
        return $this->getMockBuilder(ContainerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();
    }
}
