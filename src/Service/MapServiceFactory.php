<?php
/**
 * Code Samples.
 *
 * @author Krzysztof Kardasz <krzysztof@kardasz.eu>
 * @license MIT
 */
namespace Kardasz\Service;

use Kardasz\Service\Map\ObjectDetails\Visitor\VisitorChainInterface as ObjectDetailsVisitorChainInterface;
use Kardasz\Service\Map\ObjectSummary\Visitor\VisitorChainInterface as ObjectSummaryVisitorChainInterface;
use Psr\Container\ContainerInterface;

/**
 * Class MapServiceFactory.
 */
class MapServiceFactory implements MapServiceFactoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function create(ContainerInterface $container): MapService
    {
        return new MapService(
            $container->get(ObjectSummaryVisitorChainInterface::class),
            $container->get(ObjectDetailsVisitorChainInterface::class)
        );
    }
}
