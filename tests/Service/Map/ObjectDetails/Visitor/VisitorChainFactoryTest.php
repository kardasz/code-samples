<?php
/**
 * Code Samples.
 *
 * @author Krzysztof Kardasz <krzysztof@kardasz.eu>
 * @license MIT
 */
namespace Kardasz\Tests\Service\Map\ObjectDetails\Visitor;

use Kardasz\Service\Map\ObjectDetails\Visitor\VisitorChainFactoryInterface;
use Psr\Container\ContainerInterface;
use Kardasz\Service\Map\ObjectDetails\Visitor\Ac;
use Kardasz\Service\Map\ObjectDetails\Visitor\Distance;
use Kardasz\Service\Map\ObjectDetails\Visitor\DriveTime;
use Kardasz\Service\Map\ObjectDetails\Visitor\Fillings;
use Kardasz\Service\Map\ObjectDetails\Visitor\Odometer;
use Kardasz\Service\Map\ObjectDetails\Visitor\ParkStopTime;
use Kardasz\Service\Map\ObjectDetails\Visitor\ParkTime;
use Kardasz\Service\Map\ObjectDetails\Visitor\ParkTime300;
use Kardasz\Service\Map\ObjectDetails\Visitor\ParkTime300Count;
use Kardasz\Service\Map\ObjectDetails\Visitor\StartGeo;
use Kardasz\Service\Map\ObjectDetails\Visitor\StopGeo;
use Kardasz\Service\Map\ObjectDetails\Visitor\VisitorChainFactory;
use Kardasz\Service\Map\ObjectDetails\Visitor\VisitorChainInterface;
use Kardasz\Service\Map\ObjectDetails\Visitor\VisitorInterface;
use Kardasz\Service\Map\ObjectDetails\Visitor\Workstart;
use Kardasz\Service\Map\ObjectDetails\Visitor\Workstop;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;
use ReflectionClass;

/**
 * Class VisitorChainFactoryTest.
 */
class VisitorChainFactoryTest extends TestCase
{
    /**
     * @covers \VisitorChainFactory::create
     */
    public function testVisitors()
    {
        $container = $this->getContainerMock();

        $container
            ->expects($this->exactly(13))
            ->method('get')
            ->withConsecutive(
                [Ac::class],
                [Distance::class],
                [DriveTime::class],
                [Fillings::class],
                [Odometer::class],
                [ParkStopTime::class],
                [ParkTime::class],
                [ParkTime300::class],
                [ParkTime300Count::class],
                [StartGeo::class],
                [StopGeo::class],
                [Workstart::class],
                [Workstop::class]
            )
            ->willReturn($this->getVisitorMock());

        $subject = new VisitorChainFactory();
        $results = $subject->create($container);

        $this->assertInstanceOf(VisitorChainFactoryInterface::class, $subject);
        $this->assertInstanceOf(VisitorChainInterface::class, $results);
    }

    /**
     * @covers \VisitorChainFactory::create
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
