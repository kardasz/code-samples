<?php
/**
 * Code Samples
 * @author Krzysztof Kardasz <krzysztof@kardasz.eu>
 * @license MIT
 */

namespace Kardasz\Service\Map\ObjectDetails\Visitor;

use Psr\Container\ContainerInterface;

/**
 * Class VisitorChainFactory
 * @package Kardasz\Service\Map\ObjectDetails\Visitor
 */
class VisitorChainFactory implements VisitorChainFactoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function create(ContainerInterface $container): VisitorChainInterface
    {
        $visitorChain = new VisitorChain();

        $visitorChain->add($container->get(Ac::class));
        $visitorChain->add($container->get(Distance::class));
        $visitorChain->add($container->get(DriveTime::class));
        $visitorChain->add($container->get(Fillings::class));
        $visitorChain->add($container->get(Odometer::class));
        $visitorChain->add($container->get(ParkStopTime::class));
        $visitorChain->add($container->get(ParkTime::class));
        $visitorChain->add($container->get(ParkTime300::class));
        $visitorChain->add($container->get(ParkTime300Count::class));
        $visitorChain->add($container->get(StartGeo::class));
        $visitorChain->add($container->get(StopGeo::class));
        $visitorChain->add($container->get(Workstart::class));
        $visitorChain->add($container->get(Workstop::class));

        return $visitorChain;
    }
}
