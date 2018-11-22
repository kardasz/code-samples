<?php
/**
 * Code Samples.
 *
 * @author Krzysztof Kardasz <krzysztof@kardasz.eu>
 * @license MIT
 */
namespace Kardasz\Service;

use Psr\Container\ContainerInterface;

/**
 * Interface MapServiceFactoryInterface.
 */
interface MapServiceFactoryInterface
{
    /**
     * @param ContainerInterface $container
     *
     * @return MapService
     */
    public function create(ContainerInterface $container): MapService;
}
