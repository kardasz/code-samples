<?php
/**
 * Code Samples.
 *
 * @author Krzysztof Kardasz <krzysztof@kardasz.eu>
 * @license MIT
 */
namespace Kardasz\Service\Map\ObjectDetails\Visitor;

use Psr\Container\ContainerInterface;

/**
 * Class VisitorChainFactory.
 */
interface VisitorChainFactoryInterface
{
    /**
     * @param ContainerInterface $container
     *
     * @return VisitorChainInterface
     */
    public function create(ContainerInterface $container): VisitorChainInterface;
}
