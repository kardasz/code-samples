<?php
/**
 * Code Samples
 * @author Krzysztof Kardasz <krzysztof@kardasz.eu>
 * @license MIT
 */

namespace Kardasz\Service\Map\ObjectSummary\Visitor;

use Psr\Container\ContainerInterface;

/**
 * Interface VisitorChainFactoryInterface
 * @package Kardasz\Service\Map\ObjectSummary\Visitor
 */
interface VisitorChainFactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @return VisitorChain
     */
    public function create(ContainerInterface $container) : VisitorChainInterface;
}
