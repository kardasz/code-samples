<?php
/**
 * Code Samples.
 *
 * @author Krzysztof Kardasz <krzysztof@kardasz.eu>
 * @license MIT
 */
namespace Kardasz\Service\Map\ObjectDetails\Visitor;

/**
 * Interface VisitorChainInterface.
 */
interface VisitorChainInterface extends VisitorInterface
{
    /**
     * @param VisitorInterface $visitor
     */
    public function add(VisitorInterface $visitor): void;
}
