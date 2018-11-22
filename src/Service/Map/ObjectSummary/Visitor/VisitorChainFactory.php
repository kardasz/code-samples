<?php
/**
 * Code Samples
 * @author Krzysztof Kardasz <krzysztof@kardasz.eu>
 * @license MIT
 */

namespace Kardasz\Service\Map\ObjectSummary\Visitor;

use Psr\Container\ContainerInterface;

/**
 * Class VisitorChainFactory
 * @package Kardasz\Service\Map\ObjectSummary\Visitor
 */
class VisitorChainFactory implements VisitorChainFactoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function create(ContainerInterface $container) : VisitorChainInterface
    {
        $visitorChain = new VisitorChain();

        $visitorChain->add($container->get(Acc::class));
        $visitorChain->add($container->get(Description::class));
        $visitorChain->add($container->get(Fuel::class));
        $visitorChain->add($container->get(FuelTank::class));
        $visitorChain->add($container->get(Geo::class));
        $visitorChain->add($container->get(Geo2::class));
        $visitorChain->add($container->get(GsmSignalLevelTytan::class));
        $visitorChain->add($container->get(Id::class));
        $visitorChain->add($container->get(Name::class));
        $visitorChain->add($container->get(RideType::class));
        $visitorChain->add($container->get(Rpm::class));

        return $visitorChain;
    }
}
